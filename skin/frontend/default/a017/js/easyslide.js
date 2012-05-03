/**
 * @author Bruno Bornsztein <bruno@missingmethod.com>
 * @copyright 2007 Curbly LLC
 * @package Glider
 * @license MIT
 * @url http://www.missingmethod.com/projects/glider/
 * @version 0.0.3
 * @dependencies prototype.js 1.5.1+, effects.js
 */
/*  Thanks to Andrew Dupont for refactoring help and code cleanup - http://andrewdupont.net/  */

Glider = Class.create();
Object.extend(Object.extend(Glider.prototype, Abstract.prototype), {
    initialize: function(wrapper, options){
        this.handStopped = false;
        this.scrolling = false;
        this.wrapper = $(wrapper);
        this.scroller = this.wrapper.down('div.scroller');
        this.sections = this.wrapper.getElementsBySelector('div.section');
        this.options = Object.extend({
            duration: 1.0,
            frequency: 3
        }, options ||
        {});
        
        this.sections.each(function(section, index){
            section._index = index;
        });
        
        this.events = {
            mouseover: this.pause.bind(this),
            mouseout: this.resume.bind(this)
        };
        
        this.addObservers();
        if (this.options.initialSection && this.options.initialSection != 'section1') {
            this.moveTo(this.options.initialSection, this.scroller, {
                duration: this.options.duration
            }); // initialSection should be the id of the section you want to show up on load
        }
        if (this.options.autoGlide) {
            this.start();
        } else {
            this.handStopped = true;
        }
    },
    
    addObservers: function(){
        this.wrapper.observe('mouseover', this.events.mouseover);
        this.wrapper.observe('mouseout', this.events.mouseout);
        
        var descriptions = this.wrapper.getElementsBySelector('div.sliderdescription');
        descriptions.invoke('observe', 'mouseover', this.makeActive);
        descriptions.invoke('observe', 'mouseout', this.makeInactive);
        
        //Nubmbers    
        var controls = this.wrapper.getElementsBySelector('div.easyslidercontrol a.easyslidedirect');
        controls.invoke('observe', 'click', this.numClick.bind(this));
        
        //Arrows
        var stop = this.wrapper.getElementsBySelector('div.easyslidercontrol a.easyslidestop');
        stop.invoke('observe', 'click', this.stop.bind(this));
        
        var play = this.wrapper.getElementsBySelector('div.easyslidercontrol a.easyslideplay');
        play.invoke('observe', 'click', this.start.bind(this));
        
        var prev = this.wrapper.getElementsBySelector('div.easyslidercontrol a.easyslideprev');
        prev.invoke('observe', 'click', this.previous.bind(this));

        var next = this.wrapper.getElementsBySelector('div.easyslidercontrol a.easyslidenext');
        next.invoke('observe', 'click', this.next.bind(this));
    },
    
    numClick: function(event){
        var element = Event.findElement(event, 'a'); /*clicked link*/
        
        if (this.scrolling) {
            this.scrolling.cancel();
        }
        
        this.moveTo(element.href.split("#")[1], this.scroller, {
            duration: this.options.duration
        });
        Event.stop(event);
    },
    
    moveTo: function(element, container, options){
        this.current = $(element);
        this.current = this.wrapper.select('#' + element)[0];
        Position.prepare();
        var containerOffset = Position.cumulativeOffset(container);
        var elementOffset = Position.cumulativeOffset(this.current);
        
        this.scrolling = new Effect.SmoothScroll(container, {
            duration: options.duration,
            x: (elementOffset[0] - containerOffset[0]),
            y: (elementOffset[1] - containerOffset[1])
        });
        
        if (typeof element == 'object') {
            element = element.id;
        }
        
        this.toggleControl($$('a[href="#' + element + '"]')[0]);

        return false;
    },
    
    next: function(event){
        if (this.current) {
            var currentIndex = this.current._index;
            var nextIndex = (this.sections.length - 1 == currentIndex) ? 0 : currentIndex + 1;
        } else {
            var nextIndex = 1;
        }
        
        this.moveTo(this.sections[nextIndex].id, this.scroller, {
            duration: this.options.duration
        });
        if (event) {
            Event.stop(event);
        }
    },
    
    previous: function(event){
        if (this.current) {
            var currentIndex = this.current._index;
            var prevIndex = (currentIndex == 0) ? this.sections.length - 1 : currentIndex - 1;
        } else {
            var prevIndex = this.sections.length - 1;
        }
        
        this.moveTo(this.sections[prevIndex].id, this.scroller, {
            duration: this.options.duration
        });
        Event.stop(event);
    },
    
    makeActive: function(event){
        var element = Event.findElement(event, 'div');
        element.addClassName('active');
    },
    
    makeInactive: function(event){
        var element = Event.findElement(event, 'div');
        element.removeClassName('active');
    },
    
    toggleControl: function(el){
        if (!el) return false;
        $$('.easyslidercontrol a').invoke('removeClassName', 'active');
        el.addClassName('active');
    },
    
    stop: function(event){
        this.handStopped = true;
        clearTimeout(this.timer);
        Event.stop(event);
    },
    
    start: function(event){
        this.handStopped = false;
        this.periodicallyUpdate();
        if (event) {
            Event.stop(event);
        }
    },
    
    pause: function(event){
        if (!this.handStopped) {
            clearTimeout(this.timer);
            this.timer = null;
        }
        Event.stop(event);
    },
    
    resume: function(event){
        if (!this.handStopped) {
            this.periodicallyUpdate();
        }
    },
    
    periodicallyUpdate: function(){
        if (this.timer != null) {
            clearTimeout(this.timer);
            this.next();
        }
        this.timer = setTimeout(this.periodicallyUpdate.bind(this), this.options.frequency * 1000);
    }
    
});

Effect.SmoothScroll = Class.create();
Object.extend(Object.extend(Effect.SmoothScroll.prototype, Effect.Base.prototype), {
    initialize: function(element){
        this.element = $(element);
        var options = Object.extend({
            x: 0,
            y: 0,
            mode: 'absolute'
        }, arguments[1] ||
        {});
        this.start(options);
    },
    setup: function(){
        if (this.options.continuous && !this.element._ext) {
            this.element.cleanWhitespace();
            this.element._ext = true;
            this.element.appendChild(this.element.firstChild);
        }
        
        this.originalLeft = this.element.scrollLeft;
        this.originalTop = this.element.scrollTop;
        
        if (this.options.mode == 'absolute') {
            this.options.x -= this.originalLeft;
            this.options.y -= this.originalTop;
        }
    },
    update: function(position){
        this.element.scrollLeft = this.options.x * position + this.originalLeft;
        this.element.scrollTop = this.options.y * position + this.originalTop;
    }
});

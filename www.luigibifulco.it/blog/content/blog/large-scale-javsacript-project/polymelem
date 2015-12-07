define([], function(){

  MyElement = Polymer({

    is: 'poly-clock',

    /*utility methods*/
    start: function(){
      this.interval = setInterval(this.update.bind(this), 1000);
    },
    stop: function(){
      this.interval = clearInterval(this.interval);
    },
    update: function(){
      this.textContent = new Date().toLocaleTimeString();
    },

    /*lifecycle methods*/
    factoryImpl: function(foo, bar) {
      this.foo = foo;
      this.configureWithBar(bar);
    },

    created: function() {
      console.log(this.localName + '#' + this.id + ' was created');
      this.update();
    },

    ready: function() {
      // access a local DOM element by ID using this.$
      console.log(this.localName + '#' + this.id + ' is ready');
      this.start();
    },

    attached: function() {
      console.log(this.localName + '#' + this.id + ' was attached');

    },

    detached: function() {
      console.log(this.localName + '#' + this.id + ' was detached');
    },

    attributeChanged: function(name, type) {
      console.log(this.localName + '#' + this.id + ' attribute ' + name +
      ' was changed to ' + this.getAttribute(name));
    },

    /*events and listeners */
    listeners: {
      'tap': 'handleTimer'
    },

    handleTimer: function(e) {
      console.log(e);
      if (e.target.interval) e.target.stop();
      else e.target.start();
    },

    /*static attributes added automatically to the element
    example only they do nothing :) */
    hostAttributes: {
      'string-attribute': 'Value',
      'boolean-attribute': true,
      tabindex: 0
    }
  });
});

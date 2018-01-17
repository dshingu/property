(function(window, Mapster){
    
    $.widget( "mapster.mapster", {
      // default options
      options: {
        
      },
 
      // The constructor
      _create: function() {
        
        var element = this.element[0];
        var options = this.options;
        
        this.map = Mapster.create(element, options);
        
      },
 
      // Called when created, and later when changing options
      _refresh: function() {
        
      },
 
      // A public method to addMarker to the map
      // can be called directly via .mapster( "addMarker" )
      addMarker: function(opts) {
        return this.map.addMarker(opts);
      },
      
      findMarker: function(callback){
        this.map.findBy(callback);
      },
      
      removeMarker: function(callback){
        this.map.removeBy(callback);
      },
 
      // Events bound via _on are removed automatically
      // revert other modifications here
      _destroy: function() {
        
      },
      
      // Return markers added to the map
      markers: function(){
        return this.map.markers.items;
      },
 
      // _setOptions is called with a hash of all options that are changing
      // always refresh when changing options
      _setOptions: function() {
       
      },
 
      // _setOption is called for each individual option that is changing
      _setOption: function( key, value ) {
       
      }
    });
    
}(window, Mapster))
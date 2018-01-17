(function(window, google, List){
    
    var Mapster = (function(){
        
        function Mapster(element, options){
            
            this.gMap = new google.maps.Map(element, options);
            this.markers = List.create();
            
            if (options.cluster) {
                this.markerClusterer = new MarkerClusterer(this.gMap, [], options.cluster.options);
            }
            
            if (options.geocode) {
                this.geocoder = google.maps.Geocoder();
            }
            
            if ( options.events ) {
                
                this._attachEvents(this.gMap, options.events);
                
            }
            
        }
        
        Mapster.prototype = {
            
            // Get/set zoom level on our map
            zoom: function(level){
                if (level) {
                    this.gMap.setZoom(level);
                }else{
                    return this.gMap.getZoom();
                }
            },
            
            // Use geocode service on our map
            geocode: function(options){
              
              this.geocoder.geocode({
                address: options.address
              }, function(results, status){
              
                if (status === this.geocode.Status.OK) {
                    options.success.call(this, results, status);
                }else{
                    options.error.call(this, status);
                }
              
              });
                
            },
            
            _on: function(opts){
                
                var self = this;
                
                google.maps.event.addListener( opts.object, opts.event, function(e){
                
                    opts.callback.call(self, e, opts.object);
                
                }); 
                
            },
            
            // Attach events to map/marker object
            _attachEvents: function(obj, events){
                
                var self = this;
                
                events.forEach(function(event){
                    self._on({
                        object:     obj,
                        event:      event.name,
                        callback:   event.callback
                    });
                });
                
            },
            
            // Add Marker to map object
            addMarker: function(mOptions){
                
                var marker, self = this;
                
                mOptions.position = {
                    lat: mOptions.lat,
                    lng: mOptions.lng
                }
                
                marker = this._createMarker(mOptions);
                
                if (this.markerClusterer) {
                    this.markerClusterer.addMarker(marker);
                }
                
                this.markers.add(marker);
                
                if(mOptions.events){
                    
                    this._attachEvents(marker, mOptions.events);
                    
                }
                
                if (mOptions.content) {
                    
                    this._on({
                        object:     marker,
                        event:      'click',
                        callback:   function(){
                        
                                        var infoWindow = new google.maps.InfoWindow({
                                           content: mOptions.content 
                                        });
                                        
                                        infoWindow.open(this.gMap, marker);
                        
                                    }
                    });
                    
                    
                }
                
                return marker;  
            },
            
            findBy: function(callback){
               return this.markers.find(callback);
            },
            
            removeBy: function(callback){
                
                var self = this;
                
                self.markers.find(callback, function(markers){
                    
                    markers.forEach(function(marker){
                        
                        if (self.markerClusterer) {
                            self.markerClusterer.removeMarker(marker);
                        }else{
                            marker.setMap(null);
                        }
                    
                    });
                    
                });
                
            },
            
            _createMarker: function(mOptions){ 
                mOptions.map = this.gMap;
                return new google.maps.Marker(mOptions);
            }
            
        }
        
        return Mapster;
        
    }());
    
    Mapster.create = function(element, options){
        return new Mapster(element, options );  
    };
    
    window.Mapster = Mapster;
    
}(window, google, List))
<?php
/**
 * Created by sergeybardier@gmail.com
 * DateTime: 14.11.15 20:58
 */
namespace app\components\widgets;

use yii\widgets\InputWidget;
use yii\helpers\Html;

class GoogleAutocomplete extends InputWidget
{
    const API_URL = '//maps.googleapis.com/maps/api/js?';

    public $libraries = 'places';
    public $sensor = false;

    public $language = 'en-US';

    public $autocompleteOptions = [
        'types' => ['geocode']
    ];

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $elementId = $this->options['id'];
        $scriptOptions = json_encode($this->autocompleteOptions);
        $view = $this->getView();
        $view->registerJsFile(self::API_URL . http_build_query([
                'libraries' => $this->libraries,
                'sensor' => $this->sensor ? 'true' : 'false',
                'language' => $this->language
            ]));
        $view->registerJs(<<<JS
(function(){
    var input = document.getElementById('{$elementId}');
    var options = {$scriptOptions};

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    var geocoder = new google.maps.Geocoder();

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
       var place = autocomplete.getPlace();
       if(place.geometry!=undefined){
          geocoder.geocode({'location': place.geometry.location}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
              search:for (var i = 0; i < results.length; i++) {
                  for (var a = 0; a <  results[i].address_components.length; a++) {
                      var addressType = results[i].address_components[a].types[0];
                      if (addressType=="postal_code") {
                          var val =  results[i].address_components[a]["long_name"];
                          document.getElementById("person-zip_code").value = val;
                          break search;
                      }
                  }
              }
          }
       });
       }
    });
})();
JS
            , \yii\web\View::POS_READY);
    }
}
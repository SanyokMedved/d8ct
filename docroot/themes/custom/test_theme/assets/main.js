(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.behaviors.test_theme = {
    attach: function (context, settings) {
      console.log('Test Theme js is included.');
    }
  };

})(jQuery, Drupal, drupalSettings);

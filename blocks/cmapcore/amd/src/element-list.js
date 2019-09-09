define([
  'jquery',
  'core/ajax'
], function (
  $,
  ajax
) {
  var initialized = false;
  var mapbase = 'https://medmap.otago.ac.nz';

  function matchTagList(presentations) {
    var pres;
    var presInput;
    // match tags
    var tags = $( 'fieldset .ftags select#id_tags_officialtags > option');
    
    if (tags.length !== 0) {
      $('.presentation-list li').prepend('<input type="checkbox">');
    }
    
    $('.presentation-list li input').change(function() {
      pres = $(this).parent().text();
      presInput = $(this);
      tags.each(function(key, val) {
	pres = pres.replace(',', '');
	if (pres.indexOf(val.value) > -1) {
	  if (presInput.prop('checked')) {
	    $(val).attr('selected', 'selected');
	  } else {
	    $(val).removeAttr('selected');
	  }
	}
      });
    });
  }
  
  function getModuleElements(elementtype, moduleUrl) {
    var elements = [];
    var config = {
      p: {
	abbrev: 'pres',
	linkname: 'presentationlinks', // URL component for this type in map API
	nameprop: 'presentation_name', // element name property in returned data
	idprop: 'presentation_id', // element id property in returned data
	mapui: '/ui/presentations' // path for map frontend URL
      },
      c: {
	abbrev: 'cond',
	linkname: 'conditionlinks', // URL component for this type in map API
	nameprop: 'condition_name', // element name property in returned data
	idprop: 'condition_id', // element id property in returned data
	mapui: '/ui/conditions' // path for map frontend URL
      },
      a: {
	abbrev: 'acty',
	linkname: 'activitylinks', // URL component for this type in map API
	nameprop: 'activity_name', // element name property in returned data
	idprop: 'activity_id', // element id property in returned data
	mapui: '/ui/activities' // path for map frontend URL
      }
    }
      
    if (moduleUrl) {
      // currently, page_size=all gets rid of count, next, prev etc...
      var elementUrl = moduleUrl + '/' + config[elementtype].linkname + '/?format=json&linkage=strong&page_size=999';

      var elementdivstring = '#cmap-' + config[elementtype].abbrev + '-div';
      var elementdiv = $(elementdivstring);
      var nonediv = elementdiv.find('.noelements');
      var elementlist = elementdiv.find('.elementlist');
      var loadingmsg = elementdiv.find('.loading');

      //console.log("showing loadingmsg for " + elementtype);
      loadingmsg.show();
      $.getJSON(elementUrl, function(data) {
	var items = [];
	if (data.count === 0) {
	  loadingmsg.hide();
	  nonediv.show();
	  elementlist.hide();
	}
	else {
	  loadingmsg.hide();
	  $.each( data.results, function( key, val ) {
	    itemtext = "<li id='" + key + "'><a target='_blank' href='" + mapbase + config[elementtype].mapui + "/" + val[config[elementtype].idprop] + "'>" + val[config[elementtype].nameprop] + "</a></li>";
	    elements.push(val[config[elementtype].nameprop]);
	    items.push(itemtext);
	  });
	  $( "<ul/>", {
	    html: items.join("")
	  }).appendTo(elementlist);
	  elementlist.show();
	  matchTagList(elements);
	}
       
     }).fail(function(ex) {
	loadingmsg.hide();
	nonediv.show();
     });
    } else {
      loadingmsg.hide();
      nonediv.show();
    }
  }

  
  function getAllElements(shortname) {
    return (
      function (siteversionData, textStatus, jqXHR) {
	var modulesversionUrl = siteversionData.modulesversion.url;
	
	// Check whether module exists in map before trying to get elements;
	// if it doesn't, hide the CMap block unless editing is on.
	//
	// Ideally this would probably be done in the block PHP, and we would
	// never even get called when the module doesn't make sense.
	//
	var courseUrl = modulesversionUrl + 'modules/' + shortname + '/';
	var cmapcore = $(".block.block_cmapcore:not(.block_with_controls)");
	$.ajax({
	  url: courseUrl,
	  success: function(moduleData, textStatus, jqXHR) {
	    //console.log("got data: ", moduleData);
	    cmapcore.show();
	    getModuleElements('p', moduleData.url);
	    getModuleElements('c', moduleData.url);
	    getModuleElements('a', moduleData.url);
	  },
	  statusCode: {
	    404: function() {
	      console.log("module '" + shortname + "' not found in cmap default site version");
	      cmapcore.hide();
	    }
	  }
	});
      }
    );
  }
    
  return ({
    init: function(mapbase, courseid, shortname) {
      if (!this.initialized) {
	$('.pres-loading').show();

	if (typeof(mapbase) !== 'undefined') {
	  this.mapbase = mapbase;
	}

	var svUrl = this.mapbase + '/cmapapi/siteversions/default/';

	// getAllEvents *returns* the callback function, which is called
	// with (siteversionData, textStatus, jqXHR)
	$.ajax({
	  url: svUrl,
	  success: getAllElements(shortname),
	  statusCode: {
	    404: function() {
	      console.log("default site version not found in cmap");
	      cmapcore.hide();
	    },
	    500: function() {
	      console.log("error fetching default site version from cmap");
	      cmapcore.hide();
	    }
	  }
	});
      }
    }
  });
});

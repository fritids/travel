
// usage: log('inside coolFunc', this, arguments);
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console) {
      arguments.callee = arguments.callee.caller;
      console.log( Array.prototype.slice.call(arguments) );
  }
};
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();)b[a]=b[a]||c})(window.console=window.console||{});


$.fn.toggleCheckbox = function() {
    this.attr('checked', !this.attr('checked'));
}


 /* TWIPSY PLUGIN FOR TOOLTIPS
  * ======================================================= */

!function( $ ) {

 /* CSS TRANSITION SUPPORT (https://gist.github.com/373874)
  * ======================================================= */

  var transitionEnd

  $(document).ready(function () {

    $.support.transition = (function () {
      var thisBody = document.body || document.documentElement
        , thisStyle = thisBody.style
        , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
      return support
    })()

    // set CSS transition event type
    if ( $.support.transition ) {
      transitionEnd = "TransitionEnd"
      if ( $.browser.webkit ) {
      	transitionEnd = "webkitTransitionEnd"
      } else if ( $.browser.mozilla ) {
      	transitionEnd = "transitionend"
      } else if ( $.browser.opera ) {
      	transitionEnd = "oTransitionEnd"
      }
    }

  })


 /* TWIPSY PUBLIC CLASS DEFINITION
  * ============================== */

  var Twipsy = function ( element, options ) {
    this.$element = $(element)
    this.options = options
    this.enabled = true
    this.fixTitle()
  }

  Twipsy.prototype = {

    show: function() {
      var pos
        , actualWidth
        , actualHeight
        , placement
        , $tip
        , tp

      if (this.getTitle() && this.enabled) {
        $tip = this.tip()
        this.setContent()

        if (this.options.animate) {
          $tip.addClass('fade')
        }

        $tip
          .remove()
          .css({ top: 0, left: 0, display: 'block' })
          .prependTo(document.body)

        pos = $.extend({}, this.$element.offset(), {
          width: this.$element[0].offsetWidth
        , height: this.$element[0].offsetHeight
        })

        actualWidth = $tip[0].offsetWidth
        actualHeight = $tip[0].offsetHeight
        placement = _.maybeCall(this.options.placement, this.$element[0])

        switch (placement) {
          case 'below':
            tp = {top: pos.top + pos.height + this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'above':
            tp = {top: pos.top - actualHeight - this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'left':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth - this.options.offset}
            break
          case 'right':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width + this.options.offset}
            break
        }

        $tip
          .css(tp)
          .addClass(placement)
          .addClass('in')
      }
    }

  , setContent: function () {
      var $tip = this.tip()
      $tip.find('.twipsy-inner')[this.options.html ? 'html' : 'text'](this.getTitle())
      $tip[0].className = 'twipsy'
    }

  , hide: function() {
      var that = this
        , $tip = this.tip()

      $tip.removeClass('in')

      function removeElement () {
        $tip.remove()
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        $tip.bind(transitionEnd, removeElement) :
        removeElement()
    }

  , fixTitle: function() {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title')
      }
    }

  , getTitle: function() {
      var title
        , $e = this.$element
        , o = this.options

        this.fixTitle()

        if (typeof o.title == 'string') {
          title = $e.attr(o.title == 'title' ? 'data-original-title' : o.title)
        } else if (typeof o.title == 'function') {
          title = o.title.call($e[0])
        }

        title = ('' + title).replace(/(^\s*|\s*$)/, "")

        return title || o.fallback
    }

  , tip: function() {
      if (!this.$tip) {
        this.$tip = $('<div class="twipsy" />').html('<div class="twipsy-arrow"></div><div class="twipsy-inner"></div>')
      }
      return this.$tip
    }

  , validate: function() {
      if (!this.$element[0].parentNode) {
        this.hide()
        this.$element = null
        this.options = null
      }
    }

  , enable: function() {
      this.enabled = true
    }

  , disable: function() {
      this.enabled = false
    }

  , toggleEnabled: function() {
      this.enabled = !this.enabled
    }

  }


 /* TWIPSY PRIVATE METHODS
  * ====================== */

   var _ = {

     maybeCall: function ( thing, ctx ) {
       return (typeof thing == 'function') ? (thing.call(ctx)) : thing
     }

   }


 /* TWIPSY PLUGIN DEFINITION
  * ======================== */

  $.fn.twipsy = function (options) {
    $.fn.twipsy.initWith.call(this, options, Twipsy, 'twipsy')
    return this
  }

  $.fn.twipsy.initWith = function (options, Constructor, name) {
    var twipsy
      , binder
      , eventIn
      , eventOut

    if (options === true) {
      return this.data(name)
    } else if (typeof options == 'string') {
      twipsy = this.data(name)
      if (twipsy) {
        twipsy[options]()
      }
      return this
    }

    options = $.extend({}, $.fn[name].defaults, options)

    function get(ele) {
      var twipsy = $.data(ele, name)

      if (!twipsy) {
        twipsy = new Constructor(ele, $.fn.twipsy.elementOptions(ele, options))
        $.data(ele, name, twipsy)
      }

      return twipsy
    }

    function enter() {
      var twipsy = get(this)
      twipsy.hoverState = 'in'

      if (options.delayIn == 0) {
        twipsy.show()
      } else {
        twipsy.fixTitle()
        setTimeout(function() {
          if (twipsy.hoverState == 'in') {
            twipsy.show()
          }
        }, options.delayIn)
      }
    }

    function leave() {
      var twipsy = get(this)
      twipsy.hoverState = 'out'
      if (options.delayOut == 0) {
        twipsy.hide()
      } else {
        setTimeout(function() {
          if (twipsy.hoverState == 'out') {
            twipsy.hide()
          }
        }, options.delayOut)
      }
    }

    if (!options.live) {
      this.each(function() {
        get(this)
      })
    }

    if (options.trigger != 'manual') {
      binder   = options.live ? 'live' : 'bind'
      eventIn  = options.trigger == 'hover' ? 'mouseenter' : 'focus'
      eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur'
      this[binder](eventIn, enter)[binder](eventOut, leave)
    }

    return this
  }

  $.fn.twipsy.Twipsy = Twipsy

  $.fn.twipsy.defaults = {
    animate: true
  , delayIn: 0
  , delayOut: 0
  , fallback: ''
  , placement: 'above'
  , html: false
  , live: false
  , offset: 0
  , title: 'title'
  , trigger: 'hover'
  }

  $.fn.twipsy.elementOptions = function(ele, options) {
    return $.metadata ? $.extend({}, options, $(ele).metadata()) : options
  }

}( window.jQuery || window.ender )

/**
 * --------------------------------------------------------------------
 * jQuery customfileinput plugin
 * --------------------------------------------------------------------
 */
$.fn.customFileInput = function(){
	return $(this).each(function(){
	//apply events and styles for file input element
	var fileInput = $(this)
		.addClass('customfile-input') //add class for CSS
		.mouseover(function(){ upload.addClass('customfile-hover'); })
		.mouseout(function(){ upload.removeClass('customfile-hover'); })
		.focus(function(){
			upload.addClass('customfile-focus'); 
			fileInput.data('val', fileInput.val());
		})
		.blur(function(){ 
			upload.removeClass('customfile-focus');
			$(this).trigger('checkChange');
		 })
		 .bind('disable',function(){
		 	fileInput.attr('disabled',true);
			upload.addClass('customfile-disabled');
		})
		.bind('enable',function(){
			fileInput.removeAttr('disabled');
			upload.removeClass('customfile-disabled');
		})
		.bind('checkChange', function(){
			if(fileInput.val() && fileInput.val() != fileInput.data('val')){
				fileInput.trigger('change');
			}
		})
		.bind('change',function(){
			//get file name
			var fileName = $(this).val().split(/\\/).pop();
			//get file extension
			var fileExt = 'customfile-ext-' + fileName.split('.').pop().toLowerCase();
			//update the feedback
			uploadFeedback
				.text(fileName) //set feedback text to filename
				.removeClass(uploadFeedback.data('fileExt') || '') //remove any existing file extension class
				.addClass(fileExt) //add file extension class
				.data('fileExt', fileExt) //store file extension for class removal on next change
				.addClass('customfile-feedback-populated'); //add class to show populated state
			//change text of button	
			uploadButton.text('Change');	
		})
		.click(function(){ //for IE and Opera, make sure change fires after choosing a file, using an async callback
			fileInput.data('val', fileInput.val());
			setTimeout(function(){
				fileInput.trigger('checkChange');
			},100);
		});
		
	//create custom control container
	var upload = $('<div class="customfile"></div>');
	//create custom control button
	var uploadButton = $('<span class="customfile-button" aria-hidden="true">carica</span>').appendTo(upload);
	//create custom control feedback
	var uploadFeedback = $('<span class="customfile-feedback" aria-hidden="true">nessun file</span>').appendTo(upload);
	
	//match disabled state
	if(fileInput.is('[disabled]')){
		fileInput.trigger('disable');
	}
		
	
	//on mousemove, keep file input under the cursor to steal click
	upload
		.mousemove(function(e){
			fileInput.css({
				'left': e.pageX - upload.offset().left - fileInput.outerWidth() + 20, //position right side 20px right of cursor X)
				'top': e.pageY - upload.offset().top - $(window).scrollTop() - 3
			});	
		})
		.insertAfter(fileInput); //insert after the input
	
	fileInput.appendTo(upload);
		
	});
};

// popups function
function initPopups() {
	var _zIndex = 1000;
	var _fadeSpeed = 280;
	var _faderOpacity = 0.7;
	var _faderBackground = '#fff';
	var _faderId = 'lightbox-overlay';
	var _closeLink = 'a.btn-close, a.close, a.cancel';
	var _fader;
	var _lightbox = null;
	var _ajaxClass = 'ajax-load';
	var _openers = jQuery('a.open-popup');
	var _page = jQuery(document);
	var _minWidth = jQuery('wrapper978').outerWidth();
	var _scroll = false;

	// init popup fader
	_fader = jQuery('#'+_faderId);
	if(!_fader.length) {
		_fader = jQuery('<div />');
		_fader.attr('id',_faderId);
		//jQuery('body').prepend(_fader);
	}
	_fader.css({
		opacity:_faderOpacity,
		backgroundColor:_faderBackground,
		position:'absolute',
		overflow:'hidden',
		display:'none',
		top:0,
		left:0,
		zIndex:_zIndex
	});

	// IE6 iframe fix
	if(jQuery.browser.msie && jQuery.browser.version < 7) {
		if(!_fader.children().length) {
			var _frame = jQuery('<iframe src="javascript:false" frameborder="0" scrolling="no" />');
			_frame.css({
				opacity:0,
				width:'100%',
				height:'100%'
			});
			var _frameOverlay = jQuery('<div>');
			_frameOverlay.css({
				top:0,
				left:0,
				zIndex:1,
				opacity:0,
				background:'#000',
				position:'absolute',
				width:'100%',
				height:'100%'
			});
			_fader.empty().append(_frame).append(_frameOverlay);
		}
	}

	// lightbox positioning function
	function positionLightbox() {
		if(_lightbox) {
			var _windowHeight = jQuery(window).height();
			var _windowWidth = jQuery(window).width();
			var _lightboxWidth = _lightbox.outerWidth();
			var _lightboxHeight = _lightbox.outerHeight();
			var _pageHeight = _page.height();

			if (_windowWidth < _minWidth) _fader.css('width',_minWidth);
				else _fader.css('width','100%');
			if (_windowHeight < _pageHeight) _fader.css('height',_pageHeight);
				else _fader.css('height',_windowHeight);

			_lightbox.css({
				position:'absolute',
				zIndex:(_zIndex+1)
			});

			// vertical position
			if (_windowHeight > _lightboxHeight) {
				if (_windowWidth < _minWidth || jQuery.browser.msie && jQuery.browser.version < 7) {
					_lightbox.css({
						position:'absolute',
						top: parseInt(jQuery(window).scrollTop()) + (_windowHeight - _lightboxHeight) / 2.8
					});
				} else {
					_lightbox.css({
						position:'fixed',
						top: (_windowHeight - _lightboxHeight) / 2.8
					});
				}
			} else {
				var _faderHeight = _fader.height();
				if(_faderHeight < _lightboxHeight) _fader.css('height',_lightboxHeight);
				if (!_scroll) {
					if (_faderHeight - _lightboxHeight > parseInt(jQuery(window).scrollTop())) {
						_faderHeight = parseInt(jQuery(window).scrollTop())
						_scroll = _faderHeight;
					} else {
						_scroll = _faderHeight - _lightboxHeight;
					}
				}
				_lightbox.css({
					position:'absolute',
					top: _scroll
				});
			}

			// horizontal position
			if (jQuery(window).width() > _lightbox.outerWidth()) _lightbox.css({left:(jQuery(window).width() - _lightbox.outerWidth()) / 2});
			else _lightbox.css({left: 0});
		}
	}

	// show/hide lightbox
	function toggleState(_state) {
		if(!_lightbox) return;
		if(_state) {
			_fader.fadeIn(_fadeSpeed,function(){
				_lightbox.fadeIn(_fadeSpeed);
			});
			_scroll = false;
			positionLightbox();
		} else {
			_lightbox.fadeOut(_fadeSpeed,function(){
				_fader.fadeOut(_fadeSpeed);
				_scroll = false;
			});
		}
	}

	// popup actions
	function initPopupActions(_obj) {
		if(!_obj.get(0).jsInit) {
			_obj.get(0).jsInit = true;
			// close link
			_obj.find(_closeLink).click(function(){
				_lightbox = _obj;
				toggleState(false);
				return false;
			});
		}
	}

	// lightbox openers
	_openers.each(function(){
		var _opener = jQuery(this);
		var _target = _opener.attr('href');

		// popup load type - ajax or static
		if(_opener.hasClass(_ajaxClass)) {
			_opener.click(function(){
				// ajax load
				if(jQuery('div[rel*="'+_target+'"]').length == 0) {
					jQuery.ajax({
						url: _target,
						type: "POST",
						dataType: "html",
						success: function(msg){
							// append loaded popup
							_lightbox = jQuery(msg);
							_lightbox.find('img').load(positionLightbox)
							_lightbox.attr('rel',_target).hide().css({
								position:'absolute',
								zIndex:(_zIndex+1),
								top: -9999,
								left: -9999
							});
							jQuery('body').append(_lightbox);

							// init js for lightbox
							initPopupActions(_lightbox);

							// show lightbox
							toggleState(true);
						},
						error: function(msg){
							alert('AJAX error!');
							return false;
						}
					});
				} else {
					_lightbox = jQuery('div[rel*="'+_target+'"]');
					toggleState(true);
				}
				return false;
			});
		} else {
			if(jQuery(_target).length) {
				// init actions for popup
				var _popup = jQuery(_target);
				initPopupActions(_popup);
					// open popup
					_opener.click(function(){
					if(_lightbox) {
						_lightbox.fadeOut(_fadeSpeed,function(){
							_lightbox = _popup.hide();
							toggleState(true);
						})
					} else {
						_lightbox = _popup.hide();
						toggleState(true);
					}
					return false;
				});
			}
		}
	});

	// event handlers
	jQuery(window).resize(positionLightbox);
	jQuery(window).scroll(positionLightbox);
	jQuery(document).keydown(function (e) {
		if (!e) evt = window.event;
		if (e.keyCode == 27) {
			toggleState(false);
		}
	})
	_fader.click(function(){
		if(!_fader.is(':animated')) toggleState(false);
		return false;
	})
}


// tag input
(function($) {

	var delimiter = new Array();
	var tags_callbacks = new Array();
	
	$.fn.addTag = function(value,options) {
			var options = jQuery.extend({focus:false,callback:true},options);
			this.each(function() { 
				id = $(this).attr('id');

				var tagslist = $(this).val().split(delimiter[id]);
				if (tagslist[0] == '') { 
					tagslist = new Array();
				}

				value = jQuery.trim(value);
		
				if (options.unique) {
					skipTag = $(tagslist).tagExist(value);
				} else {
					skipTag = false; 
				}

				if (value !='' && skipTag != true) { 
                    $('<span>').addClass('tag').append(
                        $('<span>').text(value).append('&nbsp;&nbsp;'),
                        $('<a>', {
                            href  : '#',
                            title : 'Removing tag',
                            text  : 'x'
                        }).click(function () {
                            return $('#' + id).removeTag(escape(value));
                        })
                    ).insertBefore('#' + id + '_addTag');

					tagslist.push(value);
				
					$('#'+id+'_tag').val('');
					if (options.focus) {
						$('#'+id+'_tag').focus();
					} else {		
						$('#'+id+'_tag').blur();
					}
					
					if (options.callback && tags_callbacks[id] && tags_callbacks[id]['onAddTag']) {
						var f = tags_callbacks[id]['onAddTag'];
						f(value);
					}
					if(tags_callbacks[id] && tags_callbacks[id]['onChange'])
					{
						var i = tagslist.length;
						var f = tags_callbacks[id]['onChange'];
						f($(this), tagslist[i]);
					}					
				}
				$.fn.tagsInput.updateTagsField(this,tagslist);
		
			});		
			
			return false;
		};
		
	$.fn.removeTag = function(value) { 
			value = unescape(value);
			this.each(function() { 
				id = $(this).attr('id');
	
				var old = $(this).val().split(delimiter[id]);
	
				
				$('#'+id+'_tagsinput .tag').remove();
				str = '';
				for (i=0; i< old.length; i++) { 
					if (old[i]!=value) { 
						str = str + delimiter[id] +old[i];
					}
				}
				
				$.fn.tagsInput.importTags(this,str);

				if (tags_callbacks[id] && tags_callbacks[id]['onRemoveTag']) {
					var f = tags_callbacks[id]['onRemoveTag'];
					f(value);
				}
			});
					
			return false;
		};
	
	$.fn.tagExist = function(val) {
		if (jQuery.inArray(val, $(this)) == -1) {
		  return false; /* Cannot find value in array */
		} else {
		  return true; /* Value found */
		}
	};
	
	// clear all existing tags and import new ones from a string
	$.fn.importTags = function(str) {
		$('#'+id+'_tagsinput .tag').remove();
		$.fn.tagsInput.importTags(this,str);
	}
		
	$.fn.tagsInput = function(options) { 
    var settings = jQuery.extend({
      interactive:true,
      defaultText:'add a tag',
      minChars:0,
      width:'300px',
      height:'100px',
      autocomplete: {selectFirst: false },
      'hide':true,
      'delimiter':',',
      'unique':true,
      removeWithBackspace:true,
      placeholderColor:'#AFC752'
    },options);

		this.each(function() { 
			if (settings.hide) { 
				$(this).hide();				
			}
				
			id = $(this).attr('id')
			
			data = jQuery.extend({
				pid:id,
				real_input: '#'+id,
				holder: '#'+id+'_tagsinput',
				input_wrapper: '#'+id+'_addTag',
				fake_input: '#'+id+'_tag'
			},settings);
	
	
			delimiter[id] = data.delimiter;
			
			if (settings.onAddTag || settings.onRemoveTag || settings.onChange) {
				tags_callbacks[id] = new Array();
				tags_callbacks[id]['onAddTag'] = settings.onAddTag;
				tags_callbacks[id]['onRemoveTag'] = settings.onRemoveTag;
				tags_callbacks[id]['onChange'] = settings.onChange;
			}
	
			var markup = '<div id="'+id+'_tagsinput" class="tagsinput"><div id="'+id+'_addTag">';
			
			if (settings.interactive) {
				markup = markup + '<input id="'+id+'_tag" value="" data-default="'+settings.defaultText+'" />';
			}
			
			markup = markup + '</div><div class="tags_clear"></div></div>';
			
			$(markup).insertAfter(this);

			$(data.holder).css('width',settings.width);
			$(data.holder).css('height',settings.height);
	
			if ($(data.real_input).val()!='') { 
				$.fn.tagsInput.importTags($(data.real_input),$(data.real_input).val());
			}		
			if (settings.interactive) { 
				$(data.fake_input).val($(data.fake_input).attr('data-default'));
				$(data.fake_input).css('color',settings.placeholderColor);		
		
				$(data.holder).bind('click',data,function(event) {
					$(event.data.fake_input).focus();
				});
			
				$(data.fake_input).bind('focus',data,function(event) {
					if ($(event.data.fake_input).val()==$(event.data.fake_input).attr('data-default')) { 
						$(event.data.fake_input).val('');
					}
					$(event.data.fake_input).css('color','#000000');		
				});
						
				if (settings.autocomplete_url != undefined) {
				  autocomplete_options = {source: settings.autocomplete_url};
				  for (attrname in settings.autocomplete) { 
				    autocomplete_options[attrname] = settings.autocomplete[attrname]; 
				  }
				  
				  if (jQuery.Autocompleter !== undefined) {
				    $(data.fake_input).autocomplete(settings.autocomplete_url, settings.autocomplete);
				    $(data.fake_input).bind('result',data,function(event,data,formatted) {
              if (data) {
                d = data + "";
                $(event.data.real_input).addTag(d,{focus:true,unique:(settings.unique)});
              }
            });
				  } else if (jQuery.ui.autocomplete !== undefined) {
					  $(data.fake_input).autocomplete(autocomplete_options);
					  $(data.fake_input).bind('autocompleteselect',data,function(event,ui) {
  					  $(event.data.real_input).addTag(ui.item.value,{focus:true,unique:(settings.unique)});
  					  return false;
            });
				  }
					
					
				} else {
						// if a user tabs out of the field, create a new tag
						// this is only available if autocomplete is not used.
						$(data.fake_input).bind('blur',data,function(event) { 
							var d = $(this).attr('data-default');
							if ($(event.data.fake_input).val()!='' && $(event.data.fake_input).val()!=d) { 
								if( (event.data.minChars <= $(event.data.fake_input).val().length) && (!event.data.maxChars || (event.data.maxChars >= $(event.data.fake_input).val().length)) )
									$(event.data.real_input).addTag($(event.data.fake_input).val(),{focus:true,unique:(settings.unique)});
							} else {
								$(event.data.fake_input).val($(event.data.fake_input).attr('data-default'));
								$(event.data.fake_input).css('color',settings.placeholderColor);
							}
							return false;
						});
				
				}
				// if user types a comma, create a new tag
				$(data.fake_input).bind('keypress',data,function(event) { 
					if (event.which==event.data.delimiter.charCodeAt(0) || event.which==13 ) {
						if( (event.data.minChars <= $(event.data.fake_input).val().length) && (!event.data.maxChars || (event.data.maxChars >= $(event.data.fake_input).val().length)) )
							$(event.data.real_input).addTag($(event.data.fake_input).val(),{focus:true,unique:(settings.unique)});
						
						return false;
					}
				});
				//Delete last tag on backspace
				data.removeWithBackspace && $(data.fake_input).bind('keydown', function(event)
				{
					if(event.keyCode == 8 && $(this).val() == '')
					{
						 event.preventDefault();
						 var last_tag = $(this).closest('.tagsinput').find('.tag:last').text();
						 var id = $(this).attr('id').replace(/_tag$/, '');
						 last_tag = last_tag.replace(/[\s]+x$/, '');
						 $('#' + id).removeTag(escape(last_tag));
						 $(this).trigger('focus');
					};
				});
				$(data.fake_input).blur();
			} // if settings.interactive
			return false;
		});
			
		return this;
	
	};
	
	$.fn.tagsInput.updateTagsField = function(obj,tagslist) { 
		id = $(obj).attr('id');
		$(obj).val(tagslist.join(delimiter[id]));
	};
	
	$.fn.tagsInput.importTags = function(obj,val) {			
		$(obj).val('');
		id = $(obj).attr('id');
		var tags = val.split(delimiter[id]);
		for (i=0; i<tags.length; i++) { 
			$(obj).addTag(tags[i],{focus:false,callback:false});
		}
		if(tags_callbacks[id] && tags_callbacks[id]['onChange'])
		{
			var f = tags_callbacks[id]['onChange'];
			f(obj, tags[i]);
		}
	};

})(jQuery);

/*
 * Style File - jQuery plugin for styling file input elements
 *  
 * Copyright (c) 2007-2008 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Based on work by Shaun Inman
 *   http://www.shauninman.com/archive/2007/09/10/styling_file_inputs_with_css_and_the_dom
 *
 * Revision: $Id: jquery.filestyle.js 303 2008-01-30 13:53:24Z tuupola $
 *
 */

(function($) {
    
    $.fn.filestyle = function(options) {
                
        /* TODO: This should not override CSS. */
        var settings = {
            width : 250
        };
                
        if(options) {
            $.extend(settings, options);
        };
                        
        return this.each(function() {
            
            var self = this;
            var wrapper = $("<div>")
                            .css({
                                "width": settings.imagewidth + "px",
                                "height": settings.imageheight + "px",
                                "background": "url(" + settings.image + ") 0 0 no-repeat",
                                "background-position": "right",
                                "display": "inline",
                                "position": "absolute",
                                "overflow": "hidden",
								"margin-left": "6px"
                            });
                            
            var filename = $('<input class="file">')
                             .addClass($(self).attr("class"))
                             .css({
                                 "display": "inline",
                                 "width": settings.width + "px"
                             });

            $(self).before(filename);
            $(self).wrap(wrapper);

            $(self).css({
                        "position": "relative",
                        "height": settings.imageheight + "px",
                        "width": settings.width + "px",
                        "display": "inline",
                        "cursor": "pointer",
                        "opacity": "0.0"
                    });

            if ($.browser.mozilla) {
                if (/Win/.test(navigator.platform)) {
                    $(self).css("margin-left", "-142px");                    
                } else {
                    $(self).css("margin-left", "-168px");                    
                };
            } else {
                $(self).css("margin-left", settings.imagewidth - settings.width + "px");                
            };

            $(self).bind("change", function() {
                filename.val($(self).val());
            });
      
        });
        

    };
    
})(jQuery);

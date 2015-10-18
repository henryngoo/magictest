$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// Create our magictest namespace
if (typeof(magictest) == 'undefined') {
    magictest = {
        extend: function (obj) {
            window.jQuery.extend(this, obj);
        }
    };
}

/* ================== Template features ========================
 * Copyright 2015 MagicGroup, Inc.
 * Author: Phong Ngo <fuongit@gmail.com>
 * ============================================================ */
jQuery.extend(true, magictest, {
    template: {
        init: function(scope) {
            magictest.template.initLoading(scope);
        },
        initLoading: function(scope) {
            jQuery('[data-loading]', scope).each(function() {
                var $that = jQuery(this);
                $that.on('click', function(evt) {
                    var $container = jQuery($that.data('loading')).length ? jQuery($that.data('loading')) : $that;

                    if ($container.find('.magic-featured-loading').length) return false;

                    var complete = $that.data('complete');
                    var title = $that.data('title') ? $that.data('title') : '';
                    var size = $that.data('size');
                    var sizeClass = typeof size !== 'undefined' ? 'fa-' + parseInt(size) + 'x' : '';
                    var replace = $that.data('replace') ? $that.data('replace') : false;
                    var autoShow = $that.data('auto-show') == undefined ? true : $that.data('auto-show');

                    if (replace && !$container.data('cachedContent')) {
                        $container.data('cachedContent', $that.html());
                    }

                    var loadingContent = '<span class="magic-featured-loading"><i class="magic-featured-loading-icon fa fa-spinner fa-spin ' + sizeClass + '"></i>' + title + '</span>';
                    
                    $that.off('show.magicLoading').on('show.magicLoading', function(evt) {
                        if (replace) {
                            $container.empty();
                        }
                        jQuery(loadingContent).css('padding', '0px 3px').prependTo($container);
                    });

                    if (autoShow) {
                        $that.trigger('show.magicLoading');
                    }

                    if (complete) {
                        jQuery(document).bind(complete, function(evt) {
                            jQuery('.magic-featured-loading', $container).remove();
                            if (replace) {
                                $container.html($container.data('cachedContent'));
                            }
                        });
                    }
                });
            });
        },
        showMessage: function(message, type) {
            if (typeof type === 'undefined') {
                type = 'warning';
            }
            var $messageWrap = jQuery('<div class="alert alert-' + type + ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="magic-message-text"></span></div>');
            if (typeof container == 'undefined') {
                container = '.magic-modal';
            }
            $messageWrap.find('.magic-message-text').html(message);
            jQuery('.magic-message', container).html($messageWrap.prop('outerHTML'));
        }
    }
});

/* ================== Init features ========================
 * Copyright 2015 MagicGroup, Inc.
 * Author: Phong Ngo <fuongit@gmail.com>
 * ============================================================ */
jQuery.extend(true, magictest, {
    init: function (scope) {
        //template init must be started firstly
        if (typeof magictest['template']['init'] === 'function') {
            magictest['template']['init'].apply(this, [scope]);
        }
        for (feature in magictest) {
            if (feature !== 'template' && typeof magictest[feature]['init'] === 'function') {
                try {
                    magictest[feature]['init'].apply(this, [scope]);
                } catch(err){
                    magictest.log(err);
                }
            }
        }
        //trigger event
        jQuery(document).trigger('afterMagicInit', scope);
    }
});


/* ================== Log features ========================
 * Copyright 2015 MagicGroup, Inc.
 * Author: Phong Ngo <fuongit@gmail.com>
 * ============================================================ */
jQuery.extend(true, magictest, {
    log: function(msg){
        if(!window.console) return;
        console.log(msg);
        /*
        if (!window.console) window.console = {};
        if (!window.magictest.log) window.magictest.log = function () {
        };
        */
    },
    getFormData: function(form) {
        if (typeof form === 'undefined') {
            form = 'magicForm';
        }
        return JSON.parse(JSON.stringify(jQuery('#' + form).serializeObject()));
    }
});

/* ================== Ajax features ========================
 * Copyright 2015 MagicGroup, Inc.
 * Author: Phong Ngo <fuongit@gmail.com>
 * ============================================================ */
jQuery.extend(true, magictest, {
    jax: {
        call: function(func, postData, responseCb, responseFunc) {
            var targetUrl = magictest_jax_targetUrl;
            if (typeof postData === 'undefined') {
                postData = {};
            }
            postData.func = func;
            postData.csrf_token = jQuery('meta[name="csrf_token"]').attr('content'); // crsf data

            jQuery.ajax({
                url: targetUrl,
                type: 'POST',
                data: postData,
                dataType: 'JSON'
            })
            .done(function (resp) {
                try {
                    magictest.jax.onProcessResponse(resp, responseCb);
                } catch (e) {

                }
            })
            .fail(function () {
                magictest.log('error');
            })
            .always(function (data, textStatus) {
                if(responseFunc && jQuery.isFunction(responseFunc)) {
                    responseFunc.apply(undefined, [data, textStatus]);
                }
                magictest.jax.onCompletedLoading(func);
            });
        },
        onProcessResponse: function(resp, responseCb) {
            if (responseCb && jQuery.isFunction(responseCb)) {
                responseCb.apply(undefined, [resp]);
            }
        },
        onCompletedLoading: function(func) {
            jQuery(document).trigger(func + '.magicLoading');
        }
    }
});

/* ================== User features ========================
 * Copyright 2015 MagicGroup, Inc.
 * Author: Phong Ngo <fuongit@gmail.com>
 * ============================================================ */
jQuery.extend(true, magictest, {
    user: {
        showRegister: function() {
            magictest.jax.call('ShowRegister', {}, function(resp) {
                var data = resp.data;
                jQuery(data).modal({
                    show: true
                }).on('hidden.bs.modal', function (e) {
                    jQuery(this).remove();
                });
            });
        },
        submitRegister: function() {
            magictest.jax.call('Register', magictest.getFormData(), function(resp) {
                if (resp.code == 1) {
                    magictest.template.showMessage(resp.message);
                } else if (resp.code == 0) {
                    jQuery('#magicForm', '.magic-modal').remove();
                    jQuery('.magic-btn-submit', '.magic-modal').remove();
                    magictest.template.showMessage(resp.message, 'success');
                }
            });
        },
        showLogin: function() {
            magictest.jax.call('ShowLogin', {}, function(resp) {
                var data = resp.data;
                // magictest.log(resp.code);
                jQuery(data).modal({
                    show: true
                });
            });
        },
        login: function() {
            magictest.jax.call('Login', magictest.getFormData(), function(resp) {
                if (resp.code == 1) {
                    magictest.template.showMessage(resp.message);
                } else if (resp.code == 0) {
                    location.reload();
                }
            });
        }
    }
});

// Init
jQuery(document).ready(function() {
    magictest.init('body');
});
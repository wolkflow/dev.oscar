
function cLightboxSideBeforeCreate(data)
{
    data['active'] = parseInt($('.js-acitve-lightbox').data('lid'));
}

function cLightboxSideCreate(response)
{
    if (response.status) {
        $('#js-side-lightboxes-id').html(response.data['html']);
        $('#js-lightbox-input-title-id').val('');
        
        $('[data-collapse-target]').on('click', function(){
            if (!$(this).hasClass('is-expanded')) {
                var target = $('[data-collapse-block='+$(this).data('collapse-target')+']');
                $(this).parents('.col-lg-2').find($('[data-collapse-target]')).removeClass('is-expanded');
                $(this).parents('.col-lg-2').find($('[data-collapse-block]')).slideUp(200);
                $(this).addClass('is-expanded');
                $(target).stop().slideDown(200, function(){
                    $(target).removeClass('collapsed');
                });
                $('.js-acitve-lightbox').removeClass('js-acitve-lightbox');
                $(this).parent().addClass('js-acitve-lightbox')
                return false;
            }
        });

        $('[data-expand-target]').on('click', function(){
            var target = $('[data-expand-block='+$(this).data('expand-target')+']');
            
            if ($(this).hasClass('is-expanded')) {
                $(target).slideUp(200);
                $(this).removeClass('is-expanded');
            } else {
                $(target).slideDown(200);
                $(this).addClass('is-expanded');
            }
            return false;
        });
        
        // Перетаскивание объекта в сборник.
        $('.js-picture-drag').draggable({
            revert: 'invalid',
            helper: 'clone',
            cursor: 'move',
            cursorAt: { top: 35, left: 35 }
        });
        
        // Перетаскивание объекта в сборник.
        $('.js-lightbox-drop').droppable({
            drop: function(event, ui) {
                var $that = $(this);
                var $item = ui.draggable;
                
                $that.addClass('newItemAdded');
                addPictureToLignhbox($item.data('pid'), $that.data('lid'), 'side');
            }
        });
    }
}

$(document).ready(function() {
    $(document).on('click', '.js-lightbox-title', function() {
        $('#js-lightbox-active-id').val($(this).data('lid'));
    });
});
jQuery(function($){
$(document).on('click','.edroz-media-button',function(e){e.preventDefault();var b=$(this),f=b.prev('input');var frame=wp.media({title:'Seleccionar código QR',button:{text:'Usar esta imagen'},multiple:false});frame.on('select',function(){var a=frame.state().get('selection').first().toJSON();f.val(a.url).trigger('change');});frame.open();});
});

jQuery(document).ready(function(){
    
    jQuery('.miu-remove').live( "click", function(e) {
        e.preventDefault();
        var id = jQuery(this).attr("id")
        var btn = id.split("-");
        var img_id = btn[1];
        jQuery("#row-"+img_id ).remove();
    });
    
    
    var formfield;
    var img_id;
    jQuery('.Image_button').live( "click", function(e) {
        e.preventDefault();
        var id = jQuery(this).attr("id")
        var btn = id.split("-");
        img_id = btn[1];
        
        jQuery('html').addClass('Image');
        formfield = jQuery('#image'+img_id).attr('src');
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
	
    window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html){
        if (formfield==="") {
            fileurl = jQuery('img',html).attr('src');

            jQuery("#image"+img_id).attr("src", fileurl);
            jQuery('#img-'+img_id).val(fileurl);
            tb_remove();

            jQuery('html').removeClass('Image');

        } else {
            window.original_send_to_editor(html);
        }
    };
});

function addRow(image_url, partner_name, partner_url){
    if(typeof(image_url)==='undefined') image_url = "";
    if(typeof(partner_url)==='undefined') partner_url = "";
    if(typeof(partner_name)==='undefined') partner_name = "";
    itemsCount+=1;
    var emptyRowTemplate = '<tr id=row-'+itemsCount+'><td style="width: 50%;"><input type="text" style="width: 30%;" placeholder="名前" name=\'partner_name['+itemsCount+']\' value=\''+partner_name+'\' /><input type="text" style="width: 69%;" placeholder="サイト" name=\'partner_url['+itemsCount+']\' value=\''+partner_url+'\' /></td><td style="width: 30%"><img id=\'image'+itemsCount+'\' width="200" src=\''+image_url+'\' />'
    +'</td><td style="width: 20%; text-align: right;"><input type=\'hidden\' id=img-'+itemsCount+' name=\'miu_images['+itemsCount+']\' value=\''+image_url+'\' /> <input type=\'button\' href=\'#\' class=\'Image_button button\' id=\'Image_button-'+itemsCount+'\' value=\'Upload\'>'
    +'<input class="miu-remove button" type=\'button\' value=\'Remove\' id=\'remove-'+itemsCount+'\' /></td></tr>';
    jQuery('#miu_images').append(emptyRowTemplate);
}
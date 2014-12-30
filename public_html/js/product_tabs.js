


$('#savemodal3').click(function (){
    
        if ($('#create_product div.has-error').length !== 0) return;
    
        var msg   = $('#create_product').serializeArray();
        msg.push({
            name: "datatype",
            value: 'ajax'
        });
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/product/create",
            data: msg
        })
        .done(function( data ) {
            if (data.type==='DATA') {
                $('#myModalProductCreate .modal-body').html(data.html);
            }
            if (data.type==='OK') {
                $('#myModalProductCreate').modal('hide');
                window.location=window.location+'?sort=-id';                    
            }
            
        });      
});



$('#modalCr').click(function (){
        $.ajax({
            type: "POST",
            url: "/product-category/create",
            dataType: "json",
            data: {datatype: 'ajax'}
        })
        .done(function( data ) {
            if (data.type==='DATA') {                
                $('#myModal .modal-body').html(data.html);
            }
        });
});


$('#savemodal').click(function (){
    
        if ($('#create_category div.has-error').length !== 0) return;
    
        var msg   = $('#create_category').serializeArray();
        msg.push({
            name: "datatype",
            value: 'ajax'
        });
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/product-category/create",
            data: msg,
        })
        .done(function( data ) {
            if (data.type==='DATA') {
                $('#myModal .modal-body').html(data.html);
            }
            if (data.type==='OK') {
                $("#product-category_id").append( $('<option value="'+data.id+'">'+data.name+'</option>'));
                $("#product-category_id :last").attr("selected", "selected");
                $('#myModal').modal('hide');
            }
            
        });      
});


$('#modalAttr').click(function (){
        $.ajax({
            type: "POST",
            url: "/product-attribute/create",
            dataType: "json",
            data: {datatype: 'ajax'}
        })
        .done(function( data ) {
            if (data.type==='DATA') {                
                $('#myModal2 .modal-body').html(data.html);
            }
        });
});


$('table[name="product_attr_table"]').on('click', 'button[name="prod_attr_del"]', function(){
        $.ajax({
            type: "POST",
            url: "/product/product-attr-delete",
            dataType: "json",
            data: {datatype: 'ajax', prod_attr_id: $(this).attr('prod_attr_id')}
        })
        .done(function( data ) {
            if (data.type==='OK') {                
                $('table tr[prod_attr_id="'+data.id+'"]').remove();
            }
            else {
                alert (data.type);
            }
        });    
});


$('button[name="prod_attr_add"]').click(function(){
        $.ajax({
            type: "POST",
            url: "/product/product-attr-add",
            dataType: "json",
            data: {datatype: 'ajax', attr_id: $('#productattribute-id').val(), product_id: $(this).attr('product_id') }
        })
        .done(function( data ) {
            if (data.type==='OK') {                
                $('table[name="product_attr_table"] tr:last').after(data.html);
            }
            else {
                alert (data.type);
            }
        });    
});



$('#savemodal2').click(function (){
    
        if ($('#create_attribute div.has-error').length !== 0) return;
    
        var msg   = $('#create_attribute').serializeArray();
        msg.push({
            name: "datatype",
            value: 'ajax'
        });
        
        msg.push({
            name: "product_id",
            value: $('#modalAttr').attr('product_id')
        });  
     
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/product-attribute/create",
            data: msg,
        })
        .done(function( data ) {
            if (data.type==='DATA') {
                $('#myModal2 .modal-body').html(data.html);
            }
            if (data.type==='OK') {
                $("#productattribute-id").append( $('<option value="'+data.id+'">'+data.name+'</option>'));
                
                $('table[name="product_attr_table"] tr:last').after(data.html);
                
                $('#myModal2').modal('hide');
            }
            
        });      
});



$('button[name="prod_img_add"]').click(function(){
        if ($('#productimages-path').val()=='') {
            alert('Выберите файл');
            return;
        }
        $.ajax({
            type: "POST",
            url: "/product/product-img-add",
            dataType: "json",
            data: {datatype: 'ajax', path: $('#productimages-path').val(), product_id: $(this).attr('product_id') }
        })
        .done(function( data ) {
            $('#productimages-path').val('');
            if (data.type==='OK') {                
                $('table[name="product_img_table"] tr:last').after(data.html);
            }
            else {
                alert (data.type);
            }
        });    
});
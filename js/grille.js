$(function(){
      


      $('#save_gridster').click(function () {
         var s = gridster.serialize();
          $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {
                type: 'PostData',
                gridster_data: JSON.stringify(s),
                id_employee: $('#id_employee').val()    
            }
          });
      });

       $('#load_gridster').click(function () {
            gridster.remove_all_widgets();
            $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'ajax.php',
            data: {
                type: 'GetData',
                id_employee: $('#id_employee').val()    
            }
          }).done(function (data) {
            $.each(data, function(i) {
                gridster.add_widget('<div id="bundle_'+this.id+'" id_bundle="'+this.id+'">'+this.id+'</div>', this.size_x, this.size_y, this.col, this.row);

            });      
            });
        });

});

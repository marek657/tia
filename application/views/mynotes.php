<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3" id="box">



    </div>
  </div>
</div>

<script type="text/javascript"> //<!--

  $(document).ready(function(){
    load();
  });

  function load() {
    $('#box').empty();
    $('#box').append('<input type="text" class="form-control newInput" placeholder="Take a note"> <br>');
		$('#box').append('<div id="loader"></div>');

		var cl = new CanvasLoader('loader');
    cl.setColor('#FFFFFF'); // default is '#000000'
    cl.setShape('oval'); // default is 'oval'
    cl.setDiameter(20); // default is 40
    cl.setDensity(91); // default is 40
    cl.setRange(0.8); // default is 1.3
    cl.setSpeed(2); // default is 2
    cl.setFPS(60); // default is 24
    cl.show(); // Hidden by default

		$.getJSON("getNotes", function(data){
			$.each(data, function(key,value) {
					$('#box').append('<div class="panel panel-default" id="' + value.id + '"> <div class="panel-heading"> <h3 class="panel-title">' + value.name +
													 '<span class="pull-right data-toggle="collapse" data-parent="#the_items" data-target="#n_1" > <span title="Edit" id="editpicture" class="glyphicon glyphicon-edit"></span>  <a href="removeNote/' + value.id + '"><span title="Remove" class="glyphicon glyphicon-remove"></span></a> </span></h3> </div> <div class="panel-body">'
													 + value.content + '</div> </div>');
			});
			cl.hide(); // Hidden by default
		});
  }

  //replace panel with edit panel
  $(document).on("click", ".glyphicon-edit", function () {
    var dad = $(this).parent().parent();
    var title = dad.text();
    var dad2 = $(this).parent().parent().parent().parent();
    var content = dad2.children('.panel-body').text();
    var id = dad2.attr('id');
    var input = '<div id="newpanel"> <fieldset><form action="editNote/'+id+'" method="post" accept-charset="utf-8"><div class="panel panel-default">  <div class="panel-heading">  <h3 class="panel-title"> <input type="text" name="title" class="form-control" value="' + title +'" id="title" > </h3>  </div>  <div class="panel-body">  <textarea class="form-control" name="content" id="content" rows="3">' + content + '</textarea>  <br>  <button type="submit" name="submit" class="btn btn-default">Save</button>  </div>  </div></form></fieldset> </div>';
     dad2.replaceWith(input);
     $('#content').focus();
  });

  //replace input with panel
  $(document).on("click", ".newInput", function () {
    var input = '<div id="newpanel"> <fieldset><form action="createNote/" method="post" accept-charset="utf-8"><div class="panel panel-default">  <div class="panel-heading">  <h3 class="panel-title"> <input type="text" name="title" class="form-control" placeholder="Title" id="title" > </h3>  </div>  <div class="panel-body">  <textarea class="form-control" name="content" placeholder="Content" id="content" rows="3"></textarea>  <br>  <button type="submit" name="submit" class="btn btn-default">Save</button>  </div>  </div></form></fieldset> </div>';
     $(this).replaceWith(input);
     $('#content').focus();
  });

  $(document).click(function(event) {
    if (!$(event.target).closest("#newpanel").length) {
        //$("#newpanel").hide();
      }
  });

//-->
</script>

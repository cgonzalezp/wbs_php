function search(dur,start_d){
				var durr=dur;
				var start_dd=start_d;
			
				var arr= {"duracion":$('#duration').val(),"fecha_inicio":$('#start_date').val(),"fecha_fin":$('#finish_date').val()};
				//alert(arr.duracion+", "+arr.fecha_inicio+", "+arr.fecha_fin);
				$.ajax({
					url: 'ajax3.php',
					type: 'POST',
					dataType: 'json',
					data: arr,
					success: function(data) {
						
						if(data.fecha_final != null){
							$('#finish_date').val(data.fecha_final);
						}else{
							$('#finish_date').val();
						}

						/*if(data.duracion != null){
							$('#duracion').val(data.duracion);
						}else{
							$('#duracion').val();
						}*/
					}
				});
}
//aqui
function searchDur(){
//	var durr=dur;
//	var start_dd=start_d;

	var arr= {"fecha_inicio":$('#start_date').val(),"fecha_fin":$('#finish_date').val()};
	
	//alert(arr.duracion+", "+arr.fecha_inicio+", "+arr.fecha_fin);
	$.ajax({
		url: 'ajax33.php',
		type: 'POST',
		dataType: 'json',
		data: arr,
		success: function(data) {
			
			if(data.duration != null){
				$('#duration').val(data.duration);
			}else{
				$('#duration').val();
			}

			/*if(data.duracion != null){
				$('#duracion').val(data.duracion);
			}else{
				$('#duracion').val();
			}*/
		}
	});
}

function predecesoras(dur,start_d){
				var durr=dur;
				var start_dd=start_d;
			
				var arr= {"predecesora":$('#predecessors').val()};
				//alert("predecesora: "+arr.predecesora);
				$.ajax({
					url: 'ajax7.php',
					type: 'POST',
					dataType: 'json',
					data: arr,
					success: function(data) {
						
						if(data.fecha_final != null){
							$('#start_date').val(data.fecha_final);
							search();
						}else{
							$('#start_date').val();
						}

					}
				});
}
var ret;
function is_father(id) {
		
		var arr= {id_father:id};
		
		$.ajax({
			url: 'ajax4.php',
				type: 'POST',
				dataType: 'json',
				data: arr,
				success: function(data) {
//					debugger;
					if(data.resultado == "1"){
						ret=data.resultado;
						father=ret;
						alert("Es padre.");
						$(this).closest('div').attr('father').val(1);
						
					}else{
						ret=data.resultado;
						father=ret;
						alert("Es hijo.");
						$(this).closest('div').attr('father').val(0);
						
					}	
					
					
				}
		});
		return ret;
}




(function($) {
	$.fn.tree_structure = function(options) {
		var defaults = {
			'add_option': true,
			'edit_option': true,
			//'select_edit': true,
			'delete_option': true,
			'confirm_before_delete' : true,
			'animate_option': [true, 5],
			'fullwidth_option': false,
			'align_option': 'center',
			'draggable_option': true
		};
		return this.each(function() {
			if(options) $.extend(defaults, options);
			var add_option = defaults['add_option'];
			var edit_option = defaults['edit_option'];
			var delete_option = defaults['delete_option'];
			var confirm_before_delete = defaults['confirm_before_delete'];
			var animate_option = defaults['animate_option'];
			var fullwidth_option = defaults['fullwidth_option'];
			var align_option = defaults['align_option'];
			var draggable_option = defaults['draggable_option'];
			var vertical_line_text = '<span class="vertical"></span>';
			var horizontal_line_text = '<span class="horizontal"></span>';
			var add_action_text = add_option == true ? '<span class="add_action" title="Click para agregar"></span>' : '';
			var edit_action_text = edit_option == true ? '<span class="edit_action" title="Click para editar"></span>' : '';
			var delete_action_text = delete_option == true ? '<span class="delete_action" title="Click para borrar"></span>' : '';
			var highlight_text = '<span class="highlight" title="Click para resaltar | DobleClick"></span>';
			var class_name = $(this).attr('class');
			var event_name = 'pageload';
			if(align_option != 'center') $('.'+class_name+' li').css({'text-align':align_option});
			if(fullwidth_option) {
				var i = 0;
				var prev_width;
				var get_element;
				$('.'+class_name+' li li').each(function() {
					var this_width = $(this).width();
					if(i == 0 || this_width > prev_width) {
						prev_width = $(this).width();
						get_element = $(this);
					}
					i++;
				});
				var loop = get_element.closest('ul').children('li').eq(0).nextAll().length;
				var fullwidth = parseInt(0);
				for($i=0; $i<=loop; $i++) {
					fullwidth += parseInt(get_element.closest('ul').children('li').eq($i).width());
				}
				$('.'+class_name+'').closest('div').width(fullwidth);
			}
			$('.'+class_name+' li.hide').each(function() {
				$(this).children('ul').hide();
			});
			function prepend_data(target) {
				target.prepend(vertical_line_text + horizontal_line_text).children('div').prepend(add_action_text + delete_action_text + edit_action_text);
				if(target.children('ul').length != 0) target.hasClass('hide') ? target.children('div').prepend('<b class="hide show"></b>') : target.children('div').prepend('<b class="hide"></b>');
				target.children('div').prepend(highlight_text);
			}
			function draw_line(target) {
				var child_width = target.children('div').outerWidth(true) / 2;
				var child_left = target.children('div').offset().left;
				if(target.parents('li').offset() != null) var parent_child_height = target.parents('li').offset().top;
				vertical_height = (target.offset().top - parent_child_height) - target.parents('li').children('div').outerHeight(true) / 2 ;
				target.children('span.vertical').css({'height':vertical_height, 'margin-top':-vertical_height, 'margin-left':child_width, 'left':child_left});
				if(target.parents('li').offset() == null) {
					var width = 0;
				} else {
					var parents_width = target.parents('li').children('div').offset().left + (target.parents('li').children('div').width() / 2);
					var current_width = child_left + (target.children('div').width() / 2);
					var width = parents_width - current_width;
				}
				var horizontal_left_margin = width < 0 ? -Math.abs(width) + child_width : child_width;
				target.children('span.horizontal').css({'width':Math.abs(width), 'margin-top':-vertical_height, 'margin-left':horizontal_left_margin, 'left':child_left});
			}
			if(animate_option[0] == true) {
				function animate_call_structure() {
					$timeout = setInterval(function() {
						animate_li();
					}, animate_option[1]);
				}
				var length = $('.'+class_name+' li').length;
				var i = 0;
				function animate_li() {
					prepend_data($('.'+class_name+' li').eq(i));
					draw_line($('.'+class_name+' li').eq(i));
					i++;
					if(i == length) {
						i = 0;
						clearInterval($timeout);
					}
				}
			}

			function call_structure() {
				$('.'+class_name+' li').each(function() {
					if(event_name == 'pageload') prepend_data($(this));
					draw_line($(this));
				});
			}
			animate_option[0] ? animate_call_structure() : call_structure();
			event_name = 'others';
			$(window).resize(function() { call_structure(); });
			$('.'+class_name+' b.hide').live('click', function() {
				$(this).toggleClass('show');
				$(this).closest('li').toggleClass('hide').children('ul').toggle();
				call_structure();
			});
			$('.'+class_name+' li > div').live('hover', function(event) {
				if(event.type == 'mouseenter' || event.type == 'mouseover') {
					$('.'+class_name+' li > div.current').removeClass('current');
					$('.'+class_name+' li > div.children').removeClass('children');
					$('.'+class_name+' li > div.parent').removeClass('parent');
					$(this).addClass('current');
					$(this).closest('li').children('ul').children('li').children('div').addClass('children');
					$(this).closest('li').closest('ul').closest('li').children('div').addClass('parent');
					$(this).children('span.highlight, span.add_action, span.delete_action, span.edit_action').show();
				} else {
					$(this).children('span.highlight, span.add_action, span.delete_action, span.edit_action').hide();
				}
			});
			$('.'+class_name+' span.highlight').live('click', function() {
				$('.'+class_name+' li.highlight').removeClass('highlight');
				$('.'+class_name+' li > div.parent').removeClass('parent');
				$('.'+class_name+' li > div.children').removeClass('children');
				$(this).closest('li').addClass('highlight');
				$('.highlight li > div').addClass('children');
				var _this = $(this).closest('li').closest('ul').closest('li');
				find_parent(_this);
			});
			$('.'+class_name+' span.highlight').live('dblclick', function() {
				if(fullwidth_option) $('.'+class_name+'').parent('div').parent('div').scrollLeft(0);
				$('.'+class_name+' li > div').not(".parent, .current, .children").closest('li').addClass('none');
				$('.'+class_name+' li div b.hide.show').closest('div').closest('li').children('ul').addClass('show');
				$('.'+class_name+' li div b.hide').addClass('none');
				$('body').prepend('<img src="images/back.png" class="back_btn" />');
				call_structure();
				$('.back_btn').click(function() {
					$('.'+class_name+' ul.show').removeClass('show');
					$('.'+class_name+' li.none').removeClass('none');
					$('.'+class_name+' li div b.hide').removeClass('none');
					$(this).remove();
					call_structure();
				});
			});
			function find_parent(_this) {
				if(_this.length > 0) {
					_this.children('div').addClass('parent');
					_this = _this.closest('li').closest('ul').closest('li');
					return find_parent(_this);
				}
			}


		
//AQUI
			if(add_option) {
				$('.'+class_name+' span.add_action').live('click', function() {
					if($('form.add_data').length > 0) $('form.add_data').remove();
					if($('form.edit_data').length > 0) $('form.edit_data').remove();
					                
                 
                   //var addquery = '<form class="add_data"><img class="close" src="images/close.png" /><h3>Agregar detalle</h3><textarea></textarea><input type="checkbox" value="" id="hide" /><label for="hide">Ocultar nodos hijos</label><p><input type="number" placeholder="$1000" value="" id="cost" /><label for="cost"> Costo de la actividad</label></p><p><input type="text" value="" id="predecessors" /><label for="predecessors">   Actividad predecesora</label></p><p><input type="number" value="" id="duration" /><label for="duration">  duracion de la actividad</label></p><p><input type="date" value="" id="start_date" onChange="search("$(\'#duration\').val(),$(\'#start_date\').val()"")" href="javascript:;" class="calendar"/><label for="start_date">  fecha de inicio</label></p><p><input type="date" id="finish_date" name="finish_date"><label for="finish_date"> Fecha de fin</label></p><span class="submit">Guardar</span></form><div id="mensaje_error" class="errores">Campos vacios</div>';
                    var addquery = '<form class="add_data"><img class="close" src="images/close.png" /><h3>Agregar detalle</h3><textarea></textarea><input type="checkbox" value="" id="hide" /><label for="hide">Ocultar nodos hijos</label><p><input type="number" placeholder="$1000" value="" id="cost" /><label for="cost"> Costo de la actividad</label></p><p><input type="text" value="" id="predecessors" onChange="predecesoras()" href="javascript:;"/><label for="predecessors">   Actividad predecesora</label></p><p><input type="number" value="" id="duration" onChange="search()" href="javascript:;"/><label for="duration">  duracion de la actividad</label></p><p><input type="date" value="" id="start_date" onChange="search()" href="javascript:;" /><label for="start_date">  fecha de inicio</label></p><p><input type="date" id="finish_date" name="finish_date" onChange="searchDur()" href="javascript:;"><label for="finish_date"> Fecha de fin</label></p><span class="submit">Guardar</span></form><div id="mensaje_error" class="errores">Campos vacios</div>';

                     if($(this).closest('div').children('form.add_data').length == 0) {
						$(this).parent('div').append(addquery);
						if(($(this).closest('div').children('form').offset().top + $(this).closest('div').children('form').outerHeight()) > $(window).height()) {
							$(this).closest('div').children('form').css({'margin-top':-$(this).closest('div').children('form').outerHeight()});
						}
						if(($(this).closest('div').children('form').offset().left + $(this).closest('div').children('form').outerWidth()) > $(window).width()) {
							$(this).closest('div').children('form').css({'margin-left':-$(this).closest('div').children('form').outerWidth()});
						}
						$(this).closest('div').children('form').children('textarea').focus();
						$(this).closest('div').closest('li').closest('ul').children('li').children('div').addClass('zindex');
					}

									

					$('span.submit').click(function() {
						//var name= $('#html').val();
						debugger;
						var cost= $('#cost').val();
						var id_wbs= $('#id_wbs').val();
						var predecessors= $('#predecessors').val();
						var duration= $('#duration').val();
						var start_date=$('#start_date').val();
						var Project_id_project=$('#Project_id_project').val();
						var finish_date=$('#finish_date').val();
		
						

						if(cost == ""|| duration=="" || start_date== "" || finish_date==""){
							$("#mensaje_error").fadeIn();
							$("#mensaje_error").fadeOut();
							return false;
							$("#mensaje_error").fadeOut();
						}else{
							$("#mensaje_error").fadeOut();
						}


						var _addthis = $(this);
						var arreglo= new Array();
						var stringdato="";
						var concatenado="";
						if(_addthis.closest('form').find('textarea').val() != '') {
							var ajax_add_id;
							if(_addthis.closest('li').children('ul').children('li').length > 0) {

								if(_addthis.closest('li').children('ul').children('li').last().children('div').attr('id')!='NaN'){
								ajax_add_id = parseInt(_addthis.closest('li').children('ul').children('li').last().children('div').attr('id')) + 1;
								
								//alert (ajax_add_id);
								}else{
									alert("ERROR");
								}

								stringdato=ajax_add_id+"";
								arreglo=stringdato.split("");
								for(var i=0;i<arreglo.length;i++){
									concatenado+=arreglo[i]+".";
								}
								
							} else {
								ajax_add_id = _addthis.closest('div').attr('id') + 1;
								stringdato=ajax_add_id+"";
								arreglo=stringdato.split("");
								for(var i=0;i<arreglo.length;i++){
									concatenado+=arreglo[i]+".";
								}
								
							}
							var data = 'data={"action":"add", "id":"'+ajax_add_id+'", "html":"'+_addthis.closest('form').find('textarea').val().replace(/\s+/g, " ")+'", "parentid":"'+_addthis.closest('div').attr('id')+'", "showhideval":"'+_addthis.closest('form').find('input:checked').length+'", "cost":"'+document.getElementById("cost").value+'", "predecessors":"'+document.getElementById("predecessors").value+'", "duration":"'+document.getElementById("duration").value+'","start_date":"'+document.getElementById("start_date").value+'","finish_date":"'+document.getElementById("finish_date").value+'"}';
							//alert(data);
							_addthis.closest("li").before("<img src='images/load.gif' class='load' />");
							$.ajax({
								type: 'POST',
								url: 'ajax.php',
								data: data,
								success: function(data) {
									window.location.reload(); 
									_addthis.closest('li').children('ul').length > 0 ? _addthis.closest('li').children('ul').append(html_value) : _addthis.closest('li').append('<ul>'+html_value+'</ul>');
									_addthis.closest('form.add_data').closest('div').children('span.highlight, span.add_action, span.delete_action, span.edit_action').hide();
									_addthis.closest('form.add_data').remove();
									$('li > div.zindex').removeClass('zindex');
									call_structure();
									draggable_event();
									$("img.load").remove();
								}
							});
						} else {
							_addthis.closest('form').find('textarea').addClass('error');
						}
					});
					$('img.close').click(function() {
						$(this).closest('form.add_data').closest('div').children('span.highlight, span.add_action, span.delete_action, span.edit_action').hide();
						$(this).closest('form.add_data').remove();
						$('li > div.zindex').removeClass('zindex');
					});
				});
			}

			if(delete_option) {


				$('.'+class_name+' span.delete_action').live('click', function() {

					if($(this).closest('div').attr('id')=="1"){
						alert("Imposible eliminar este elemento. Debe eliminar el proyecto completo.");
					}else{

					var _deletethis = $(this);
					var target_element = $(this).closest('li').closest('ul').closest('li');
					confirm_message = 1;

				
					if(confirm_before_delete) {
							var confirm_text = $(this).closest('li').children('ul').length == 0 ? "¿Esta seguro de eliminar este elemento ?" : "¿Esta seguro de eliminar este elemento y sus actividades asociadas?";
							confirm_message = confirm(confirm_text);
						}

					if(confirm_message) {
						$(this).closest('li').addClass('ajax_delete_all');
						ajax_delete_id = Array();
						ajax_delete_id.push($(this).closest('div').attr('id'));
						$('.ajax_delete_all li').each(function() {
							ajax_delete_id.push($(this).children('div').attr('id'));
						});
						$(this).closest('li').removeClass('ajax_delete_all');
						var data = 'data={"action":"delete", "id":"'+ajax_delete_id+'"}';
						$(this).closest("li").before("<img src='images/load.gif' class='load' />");
						$.ajax({
							type: 'POST',
							url: 'ajax.php',
							data: data,
							success: function(data) {
								$("img.load").remove();
								_deletethis.closest('li').fadeOut().remove();
								call_structure();
								if(target_element.children('ul').children('li').length == 0) target_element.children('ul').remove();
								window.location.reload(); 
							}
						});
					}
				}//else
			});
		
		}
//			aqui
			if(edit_option) {
				
				$('.'+class_name+' span.edit_action').live('click', function() {     	
					

					if($('form.add_data').length > 0) $('form.add_data').remove();
					if($('form.edit_data').length > 0) $('form.edit_data').remove();
					var edit_string = $(this).closest('div').clone();
					if(edit_string.children('span.highlight').length > 0) edit_string.children('span.highlight').remove();
					if(edit_string.children('span.delete_action').length > 0) edit_string.children('span.delete_action').remove();
					if(edit_string.children('span.add_action').length > 0) edit_string.children('span.add_action').remove();
					if(edit_string.children('span.edit_action').length > 0) edit_string.children('span.edit_action').remove();
					if(edit_string.children('b.hide').length > 0) edit_string.children('b.hide').remove();
					var checked_val = $(this).closest('li').hasClass('hide') ? 'checked' : '';
                    
                    var edit_select_id;
					edit_select_id=$(this).closest('div').attr('id');

//					is_father(edit_select_id);
					debugger;
					$.ajax({
						url: 'ajax2.php',
						type: 'POST',
						dataType: 'json',
						data: { number: edit_select_id }
					})
					.done(function(resp) {
						console.log("success");
						
						
						$("#cost").val(resp.cost);
						$("#predecessors").val(resp.predecessors);
						$("#duration").val(resp.duration);
						$("#start_date").val(resp.start_date);
						$("#finish_date").val(resp.finish_date);
						document.getElementById("names").value=resp.names;
						//$("#father").val(resp.father);
						
					})
					.fail(function() {
						console.log("error");
					});
					
					
					
					
					//is_father(edit_select_id);
				
                   if($(this).closest('div').attr('father')=="1"){
                	   
                    	var editquery = '<form class="edit_data"><img class="close" src="images/close.png" /><h3>Editar Detalles</h3><textarea id="names" name="names" disabled=true>'+edit_string.html()+'</textarea><input type="hidden" id="father" name="father" value=""><input type="checkbox" '+checked_val+' value="" id="hide" disabled=true/> <label for="hide">Ocultar nodos hijos</label><p><input type="number" name="cost" placeholder="1000" value="" id="cost"/><label for="cost"> Costo de la actividad</label></p><p><input type="text" value="" id="predecessors" disabled=true/><label for="predecessors">   Actividad predecesora</label></p><p><input type="number" value="" id="duration" disabled=false/><label for="duration">  duracion de la actividad</label></p><p><input type="date" value="" id="start_date"/><label for="start_date">  fecha de inicio</label></p><p><input type="date" value="" id="finish_date" /><label for="finish_date">  fecha de fin</label></p></form>';
                	
                   }else{
                	   
                    	var editquery = '<form class="edit_data"><img class="close" src="images/close.png" /><h3>Editar Detalles</h3><textarea id="names" name="names">'+edit_string.html()+'</textarea><input type="hidden" id="father" name="father" value=""><input type="checkbox" '+checked_val+' value="" id="hide" /> <label for="hide">Ocultar nodos hijos</label><p><input type="number"  name="cost" placeholder="$1000" value="" id="cost" /><label for="cost"> Costo de la actividad</label></p><p><input type="text" value="" id="predecessors" onChange="predecesoras()" href="javascript:;"/><label for="predecessors">   Actividad predecesora</label></p><p><input type="number" value="" id="duration" onChange="search()" href="javascript:;"/><label for="duration">  duracion de la actividad</label></p><p><input type="date" value="" id="start_date" onChange="search()" href="javascript:;"/><label for="start_date">  fecha de inicio</label></p><p><input type="date" value="" id="finish_date" onChange="search()" href="javascript:;" /><label for="finish_date">  fecha de fin</label></p><span class="edit">Guardar</span></form>';
                	
                   }
                   
                   
                   
                   
                   
					if($(this).closest('div').children('form.edit_data').length == 0) {
						$(this).closest('div').append(editquery);
					
						if(($(this).closest('div').children('form').offset().top + $(this).closest('div').children('form').outerHeight()) > $(window).height()) {
							$(this).closest('div').children('form').css({'margin-top':-$(this).closest('div').children('form').outerHeight()});
						}
						if(($(this).closest('div').children('form').offset().left + $(this).closest('div').children('form').outerWidth()) > $(window).width()) {
							$(this).closest('div').children('form').css({'margin-left':-$(this).closest('div').children('form').outerWidth()});
						}
						$(this).closest('div').children('form').children('textarea').select();
						$(this).closest('div').closest('li').closest('ul').children('li').children('div').addClass('zindex');
					}



					$('span.edit').click(function() {

						var _editthis = $(this);
						if(_editthis.closest('form').find('textarea').val() != '') {
							
							//var data = 'data={"action":"edit", "id":"'+_editthis.closest('div').attr('id')+'", "html":"'+_editthis.closest('form').find('textarea').val().replace(/\s+/g, " ")+'", "parentid":"'+_editthis.closest('div').attr('id')+'", "showhideval":"'+_editthis.closest('form').find('input:checked').length+' ", "cost":"'+document.getElementById("cost").value+'", "predecessors":"'+document.getElementById("predecessors").value+'","duration":"'+document.getElementById("duration").value+'","start_date":"'+document.getElementById("start_date").value+'","finish_date":"'+document.getElementById("finish_date").value+'"}';
							var data = 'data={"action":"edit", "id":"'+_editthis.closest('div').attr('id')+'", "html":"'+_editthis.closest('form').find('textarea').val().replace(/\s+/g, " ")+'", "parentid":"'+_editthis.closest('div').attr('id')+'", "showhideval":"'+_editthis.closest('form').find('input:checked').length+' ", "cost":"'+document.getElementById("cost").value+'", "predecessors":"'+document.getElementById("predecessors").value+'","duration":"'+document.getElementById("duration").value+'","start_date":"'+document.getElementById("start_date").value+'","finish_date":"'+document.getElementById("finish_date").value+'"}';

							_editthis.closest("li").before("<img src='images/load.gif' class='load' />");
							//alert(data);
							$.ajax({
								type: 'POST',
								url: 'ajax.php',
								data: data,
								success: function(data) {
									if(_editthis.closest('form').find('input:checked').length > 0) {
										if(_editthis.closest('li').hasClass('hide') == false) {
											_editthis.closest('div').find('b.hide').trigger('click');
										}
									} else {
										if(_editthis.closest('li').hasClass('hide')) {
											_editthis.closest('div').find('b.hide').trigger('click');
										}
									}
									var element_target = _editthis.closest('form.edit_data').closest('div');
									var edit_html = "";
									edit_html = _editthis.closest('form').find('textarea').val();
									element_target.children('span.edit_action').nextAll().remove();
									if(element_target.text().length > 0) element_target.html(element_target.html().replace(element_target.text(), ''));
									element_target.append(edit_html);
									element_target.children('span.highlight, span.add_action, span.delete_action, span.edit_action').hide();
									$('li > div.zindex').removeClass('zindex');
									call_structure();
									$("img.load").remove();
									window.location.reload();
								}
							});
						} else {
							_editthis.closest('form').find('textarea').addClass('error');
						}

					});

					$('img.close').click(function() {
						$(this).closest('form.edit_data').closest('div').children('span.highlight, span.add_action, span.delete_action, span.edit_action').hide();
						$(this).closest('form.edit_data').remove();
						$('li > div.zindex').removeClass('zindex');
					});
				});
			}
			if(draggable_option) {
				function draggable_event() {
					
					$('.'+class_name+' li > div').draggable({
						cursor: 'move',
						distance: 40,
						zIndex: 5,
						revert : true,
						revertDuration: 100,
						snap: '.tree li div',
						snapMode: 'inner',
						start: function(event, ui) {
							$('li.li_children').removeClass('li_children');
							$(this).closest('li').addClass('li_children');
						},
						stop: function(event, ul) { droppable_event(); }
					});
				}
				function droppable_event() {
					$('.'+class_name+' li > div').droppable({
						accept: '.tree li div',
						drop: function(event, ui) {
							debugger;
							$('div.check_div').removeClass('check_div');
							$('.li_children div').addClass('check_div');
							if($(this).hasClass('check_div')) {
								alert('No me puedo mover, el elemento es secundario.');
							} else {
							//-------------------------------------//
							var _addthis = $(this);
							var arreglo= new Array();
							var stringdato="";
							var concatenado="";
							var ajax_add_id;
							if(_addthis.closest('li').children('ul').children('li').length > 0) {

								if(_addthis.closest('li').children('ul').children('li').last().children('div').attr('id')!='NaN'){
								ajax_add_id = parseInt(_addthis.closest('li').children('ul').children('li').last().children('div').attr('id')) + 1;
								
								
								//alert(ajax_add_id);
								}else{
									alert("ERROR");
								}

								stringdato=ajax_add_id+"";
								arreglo=stringdato.split("");
								for(var i=0;i<arreglo.length;i++){
									concatenado+=arreglo[i]+".";
								}
								
							} else {
								ajax_add_id = _addthis.closest('div').attr('id') + 1;
								stringdato=ajax_add_id+"";
								arreglo=stringdato.split("");
								for(var i=0;i<arreglo.length;i++){
									concatenado+=arreglo[i]+".";
								}
								
							}
					
								
								//---------------------------------------//
								var data = 'data={"action":"drag","new_id":"'+ajax_add_id+'", "id":"'+$(ui.draggable[0]).attr('id')+'", "parentid":"'+$(this).attr('id')+'"}';
								//alert(data);
								//var data = 'data={"action":"drag", "id":"'+$(ui.draggable[0]).attr('id')+'", "parentid":"'+$(this).attr('id')+'"}';
								$.ajax({
									type: 'POST',
									url: 'ajax.php',
									data: data,
									success: function(data) {
										window.location.reload(); 
									}
									
								});
								$(this).next('ul').length == 0 ? $(this).after('<ul><li>'+$(ui.draggable[0]).attr({'style':''}).closest('li').html()+'</li></ul>') : $(this).next('ul').append('<li>'+$(ui.draggable[0]).attr({'style':''}).closest('li').html()+'</li>');
								$(ui.draggable[0]).closest('ul').children('li').length == 1 ? $(ui.draggable[0]).closest('ul').remove() : $(ui.draggable[0]).closest('li').remove();
								call_structure();
								draggable_event();
							}
						}
					});
				}
				$('.'+class_name+' li > div').disableSelection();
				draggable_event();
			}
		});
	};
})(jQuery);
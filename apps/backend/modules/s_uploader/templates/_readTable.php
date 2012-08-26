<?php use_stylesheet('/js/plugin/data_tables/css/demo_table.css')?>
<?php use_stylesheet('/css/new/plugin/ui/smoothness/jquery-ui-1.8.10.custom.css')?>
<?php use_stylesheet('/js/plugin/data_tables/extras/colVis/css/ColVis.css')?>
<?php use_javascript('/js/plugin/data_tables/js/jquery.dataTables.min.js')?>
<?php use_javascript('/js/plugin/data_tables/extras/colVis/js/ColVis.min.js')?>
<?php use_javascript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js')?>
<script type="text/javascript" charset="utf-8"><!--
/*
 * Функция возвращает маску таблицы
 */
var getHead = function() {
	var returnData = new Array();
	var aHead = new Array();
	$('table[class="display"]:first thead th').each(function(index, element){
		oCol = { entity: $(this).attr('abbr'), description: $(this).html()};
		aHead[index] = oCol;
		});
	returnData.push(aHead);
	return aHead;
	};
			$(document).ready(function() {

			/*
			* Сохраняем первоначальное состояние колонок
			*/
			var deafultHead = getHead();

			$('#baseEntity > div').draggable({
				    cursorAt: {cursor: "crosshair", top: -5, left: -5 },
				    revert: true

			});

			var droppedTH;
			$('#price th').droppable({
				drop: function(event, ui) {
					  if(ui.draggable.attr("id") == "descriptionEntity") {
						droppedTH = $(this);
						$( "#dialog-form" ).dialog("open");
					  }
					  $(this).html(ui.draggable.html());
					  $(this).attr('abbr', ui.draggable.attr('id'));

					},
				tolerance: 'pointer'
				});
			/*
			* Возвращает значения колонок в первоначальный вариант
			*/
			$('#resetAll').click(function(){
				i=0;
				$('table[class="display"]:first thead th').each(function(){
					$(this).html(deafultHead[i][1]);
					i++;
				});
			});

			/*
			* Выделение строк
			*/
			$("#price tr").click(function(event) {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');

			});

			/*
			* Удаление выделенных строк
			*/
			$('#deleteRow').click( function() {
				var anSelected = fnGetSelected( oTable );
				for (var key in anSelected) {
					oTable.fnDeleteRow( anSelected[key] )
				}
			});

			/*
			* Настройка datatables
			*/
			var oTable = $('#price').dataTable({
					"bPaginate": false,
					"sPaginationType": "full_numbers",
					"oLanguage": {
						"sLengthMenu": "Показывать _MENU_ записей на страницу",
						"sZeroRecords": "Ничего не найдено",
						"sInfo": "Показано с  _START_ по _END_ из _TOTAL_ записей",
						"sInfoEmpty": "Showing 0 to 0 of 0 records",
						"sInfoFiltered": "(filtered from _MAX_ total records)",
						"sSearch": "Поиск"
					},
					"bSort": false,
					"sScrollX": "100%",
					"sScrollY": "500px",
					"bScrollCollapse": true,
					"sDom": 'C<"clear">lfrtip',
					"oColVis": {
						"buttonText" : "Убрать колонки",
						"sRestore"   : "Вернуть все колонки",
						"bRestore"   : true

					}


					});

			/*
			* Get the rows which are currently selected
			*/
			function fnGetSelected( oTableLocal )
			{
				var aReturn = new Array();
				var aTrs = oTableLocal.fnGetNodes();

				for ( var i=0 ; i<aTrs.length ; i++ )
				{
					if ( $(aTrs[i]).hasClass('row_selected') )
					{
						aReturn.push( aTrs[i] );
					}
				}
				return aReturn;
			}

			/*
			* Отправляет массивы заголовка и данных таблицы
			*/
		    $('#parseTable').click(function(){

				var tableData = fnGetVisibleData();
				$( "#dialog-parse-status" ).dialog("open");
				$(".ui-dialog-titlebar-close").hide();


				$.ajax({
					url: '<?php echo url_for('yml_company_parse_excel')?>',
					type: 'POST',
					data: ({tableData: tableData}),
					//dataType: 'json',
					cache: false,
					timeout: 1000,
					success: function() {
						$( "#dialog-parse-status > div").html('Загрузка завершена');
						$(".ui-dialog-titlebar-close").show();
					},
					error:  function(jqXHR, textStatus, errorThrown) {
						$( "#dialog-parse-status").attr('title','Произошла ошибка');
						$( "#dialog-parse-status > div" ).html(textStatus + ' ' +errorThrown);
					}
				});
		    });

			/*
			* Возвращает массив [rows[columns]] видимых данных таблицы
			*/
		    var fnGetVisibleData = function() {
			    head = getHead();
			    var returnData = new Array();
			    var aData = oTable.fnGetNodes();
			    for (var key in aData) {
				    var rowData = { nameEntity : '',
						            priceEntity : '',
						            descriptionEntity : '',
						            categoryEntity : ''
							       };

				    $(aData[key]).children('td').each(function(index, element){

					    switch(head[index].entity)
					    {
					    	case "descriptionEntity":
					    		rowData.descriptionEntity += head[index].description + ': ' + $(this).html() + "\n\r";
						    	break;
					    	case "nameEntity":
					    		rowData.nameEntity += $(this).html() + ' ';
						    	break;
					    	case "priceEntity":
					    		rowData.priceEntity = $(this).html();
						    	break;
					    	case "categoryEntity":
					    		rowData.categoryEntity = $(this).html();
						    	break;
					    }

					    });

				    returnData.push(rowData);
			    }

			    return returnData;
		    };

			/*
			* Инициализация диалогового окна
			*/
			$( "#dialog-form" ).dialog({
				autoOpen: false,
				height: 150,
				width: 350,
				modal: true,
				buttons: {
					"Добавить": function() {
							droppedTH.html($('#prefixName').val());
							$( this ).dialog( "close" );
					},
					"Закрыть" : function() {
						$( this ).dialog( "close" );
					}
				},
				close: function(event, ui) {

				}
			});

			/*
			* Инициализация окна pfuheprb
			*/
			$( "#dialog-parse-status" ).dialog({
				autoOpen: false,
				height: 150,
				width: 350,
				resizable: false,
				modal: true,
				closeOnEscape: false,
				draggable: false
			});



});

</script>
<div id="dialog-form" title="Перед данными вставить: ">
	<form>
	<fieldset>
		<label for="prefixName">Префикс поля:</label>
		<input type="text" name="prefixName" id="prefixName" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
<div id="dialog-parse-status" title="Идет загрузка...">
	<div>
		Подождите, идет загрузка <img src="/images/loader/loader_small4.gif" width="24" height="24" alt="..." />
	</div>
</div>

<div id="baseEntity" class="entity">
	<div id="nameEntity">Название товара</div>
	<div id="priceEntity">Цена товара</div>
	<div id="descriptionEntity">Описание товара</div>
	<div id="categoryEntity">Категория товара</div>
</div>
<div id="functions" class="entity">
	<div id="deleteRow">Удалить выбранные строки</div>
	<div id="resetAll">Сбросить все</div>
	<div id="parseTable">Загрузить данные в базу</div>
</div>

<?php echo '<table id="price" cellpadding="0" cellspacing="0" border="0" class="display">
	<thead>
		<tr>'; ?>
<?php for($i=1;$i<=$countColumns;$i++): ?>
			<?php echo '<th abbr="">Колонка'.$i.'</th>' ?>
<?php endfor;?>
<?php echo '</tr>
	</thead>
	<tbody>
';
	foreach ($worksheet->getRowIterator() as $row) {
        echo '<tr>';
        //echo '<td>'.$row->getRowIndex().'</td>';
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
		foreach ($cellIterator as $cell) {
			if (!is_null($cell)) {
				echo '<td>' . $cell->getCalculatedValue() . "</td>";
			}
		}
		echo '</tr>';

	}
	echo '</tbody>
			<tfoot>
		<tr>'; ?>
<?php for($i=1;$i<=$countColumns;$i++): ?>
			<?php echo '<th>Колонка'.$i.'</th>' ?>
<?php endfor;?>
<?php echo'</tr>
	</tfoot>
		</table>';
	?>

<html>
<head>
	<title>Chess Board</title>
	<link rel="stylesheet" type="text/css"
	href="chess.css" />
	<script>
		function drag(event) // Начало переноса объекта
		{
			// функция вызывается при возникновении события "drag"
			// event - вся информация, связанная с этим событием
			// event.target - объект, С КОТОРОГО произошло событие
			// event.target.id - id-код переносимого объекта
			// event.dataTransfer - контейнер для хранения переносимой информации
			event.dataTransfer.setData("id", event.target.id);
			// В результате выполнения этой функции мы добавим
			// в event-объект переносимую информацию в поле 'text'
			// мы поместим туда id блока, который переносится
		 	//	alert (event.target.id); // раскомментировать для тестирования
		}

		function allowDrop(event) // Разрешение переноса объекта
		{
			// Площадка для получения перенесённого объекта
			// должна рапортовать о готовности его принять
			event.preventDefault();
			// Этой функцией мы отменяем действие по умолчанию,
			// которое запрещает принятие объекта,
			// таким образом выражаем готовность принять объект.
		}

		function drop(event) // посадка перенесённого объекта
		{
			// event - вся информация, связанная с этим событием
			// event.target - объект НА КОТОРЫЙ происходит событие,
			// куда приземляемся
			event.preventDefault(); // отмена действия по умолчанию
			// получаем сохранённый id-код объекта в контейнере переноса
			var id = event.dataTransfer.getData("id");
			// document.getElementById(id) - это доступ к исходному переносимому объекту
			if (id == event.target.id) // если мы ставим фигуру на то же место
				return; // то сразу выходим - ничего делать не нужно
			if (event.target.hasChildNodes()) // если там уже есть фигура
				event.target.removeChild(event.target.childNodes[0]); // удалить её
			event.target.appendChild(document.getElementById(id));
			// Добавляем перенесённую фигуру на целевую клетку
		}

	</script>
</head>
<body>
	<div class="board">
<?php 		//012345678
	$abc   = ".abcdefgh";
	$white = "PRNBQKBNR";
	$black = "prnbqkbnr";
			//012345678

	function getFigureHTML ($figure)
	{
		$codes = "KQRBNPkqrbnp";
		$nr = strpos ($codes, $figure);
		if ($nr === false)
			return "";
		return "&#" . (9812 + $nr);
	}

	for ($x = 'a'; $x <= 'h'; $x ++)
	{
		$board [$x . "2"] = $white [0];
		$board [$x . "7"] = $black [0];
	}

	for ($y = 1; $y <= 8; $y ++)
	{
		$board [$abc [$y] . "1"] = $white [$y];
		$board [$abc [$y] . "8"] = $black [$y];
	}	

	for ($y = 8; $y >=1; $y --)
		for ($x = 'a'; $x <='h'; $x ++)
			echo "<div ondrop='drop(event)'
				ondragover='allowDrop(event)' class='" .
				((ord ($x) + $y) % 2 ?
					"white" : "black") .
				"'><span draggable='true'
						ondragstart='drag(event)' id='$x$y'>" .
				    getFigureHTML (@$board [$x . $y]) .
				"</span></div>";
?>
</div>
</body>
</html>

<?php
$notes = ["do" => "C", "ré" => "D", "mi" => "E", "fa" => "F", "sol" => "G", "la" => "A", "si" => "B"];
$formHtml =  '<form id="formulaire" method="POST" action="index.php" class="form-line p-5">'.
             '<img src="image/partition_music.jpg" alt="partition-music" class="image-before-label">'.
             '<label class="mr-sm-2 text-center py-3" for="noteSelect">Choisissez une note de musique:</label>'.
             '<select id="noteSelect" class="form-control text-center mx-auto"  name="note_classique" style="width:50%;">'.
             '<option value=""></option>';
foreach ($notes as $noteClassique => $correspondanceAmericaine) {
    $formHtml .='<option value="' .$noteClassique .'">'.$noteClassique .'</option>';
}
$formHtml .= '</select>'.
             '<div id="messageDisplay" class="col-md-12 text-center m-3 p-3 auto"></div>';
             '</form>';
echo $formHtml;
?>
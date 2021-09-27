<form class="popup" action="<?php echo URLROOT; ?>/popup/" method="post">
    <div class="popupHead">
        <h1>Titulo</h1>
        <hr>
    </div>
    <div class="popupInputs">
        <input type="text" style="display: none;" name="origen" value="<?php echo $data['rutaAnterior'] ?>">
    </div>
    <button class="popupBtnConfirmar">Confirmar</button>
    <button type="button" class="popupBtnCancelar" id="closePopup">Cancelar</button>

</form>
<div class="blurr"></div>
<script src="<?php echo URLROOT; ?>/public/js/popups.js"></script>
</body>

</html>
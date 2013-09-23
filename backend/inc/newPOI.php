<div id="myCampo" class="reveal-modal">
       <div class="profile">
            <div class="clearfix padd5">
            <div id="cerrarMapa" class="amaga"><i id="closeButt" class="icol-cross"></i></div>
            <div id="googleMap"></div>
               <label for="campoNameField">Nombre del Campo</label><input type="text" id="campoNameField" name="campoNameField" />
               <label for="hoyosQuantity">Número de hoyos</label><select id="hoyosQuantity" name="hoyosQuantity" /><option value="9">9</option><option value="18">18</option></select>
                <label for="salidasDefinidas">Salidas</label><input type="checkbox" value="ffffff" id="whiteCheck"><lable for="whiteCheck">Blancas</label><input type="checkbox" value="e54848" id="redCheck"><lable for="redCheck">Rojas</label><input type="checkbox" value="48a0e5" id="blueCheck"><lable for="blueCheck">Azules</label><br/>
                <label for="logoField">Logo/Foto</label><img src="#" for="logoField" id="prevImg" alt="preview"/><input type="file"  accept="image/x-png, image/gif, image/jpeg" id="logoField" name="logoField" />
                <div id="direccionDivField"><label for="direccionField">Dirección</label><input type="text" id="direccionField" name="direccionField" /></div><div id="posicionDivField"><label for="posicionField">Posición</label><input readonly="true" placeholder="Clic para desplegar mapa" type="text" id="posicionField" name="posicionField" /></div>
                <label for="telefonoField">Teléfono</label><input type="text" id="telefonoField" name="telefonoField" />
                <label for="emailField">E-mail</label><input type="text" id="emailField" name="emailField" />
                <label for="siteField">Website</label><input type="text" id="siteField" name="siteField" />
               <br/> <button id="addCampoNuevo" class="btn btn-success"><i class="icol-layer-treansparent"></i> Añadir</button>
            </div>
         </div>
</div>
<div id="myPOI" class="reveal-modal">
       <div class="profile">
            <div class="clearfix padd5">
            <div id="cerrarMapa" class="amaga"><i id="closeButt" class="icol-cross"></i></div>
            <div id="googleMap"></div>
               <label for="campoNameField">Nom del POI</label><input type="text" id="campoNameField" name="campoNameField" />
               <label for="campoNameField">Descripció del POI</label><textarea id="campoNameField" name="campoNameField" ></textarea>
                <label for="logoField">Logo/Foto</label><img src="#" for="logoField" id="prevImg" alt="preview"/><input type="file"  accept="image/x-png, image/gif, image/jpeg" id="logoField" name="logoField" />
                <div id="direccionDivField"><label for="direccionField">Adreça (carrer num, ciutat, C.P)</label><input type="text" id="direccionField" name="direccionField" /></div><div id="posicionDivField"><label for="posicionField">Posició (més precisió)</label><input readonly="true" placeholder="Clic para desplegar mapa" type="text" id="posicionField" name="posicionField" /></div>
                <label>Selecciona el ZIP de la vista 360º generat amb el KRPANO: <input type="file" name="zip_file" /></label>
                <label for="telefonoField">Telefon</label><input type="text" id="telefonoField" name="telefonoField" />
                <label for="emailField">E-mail</label><input type="text" id="emailField" name="emailField" />
                <label for="siteField">Web</label><input type="text" id="siteField" name="siteField" />
               <br/> <button id="addPOINou" class="btn btn-success"><i class="icol-layer-treansparent"></i> Afegir</button>
            </div>
         </div>
</div>
<div id="myPOI" class="reveal-modal">
       <div class="profile">
            <div class="clearfix padd5">
            <div id="cerrarMapa" class="amaga"><i id="closeButt" class="icol-cross"></i></div>
            <div id="googleMap"></div>
               <label for="POINameField">Nom del POI</label><input type="text" id="POINameField" name="campoNameField" />
               <label for="POIDescription">Descripció del POI</label><textarea id="POIDescription" name="POIDescription" ></textarea>
                <label for="logoField">Logo/Foto</label><img src="#" for="logoField" id="prevImg" alt="preview"/>
                <div id="imgFileField"><input type="file" accept="image/png, image/x-png, image/gif, image/jpeg, image/jpg" id="imgField" name="imgField" /></div>
                <div id="direccionDivField"><label for="direccionField">Adreça (carrer num, ciutat, C.P)</label><input type="text" id="direccionField" name="direccionField" /></div><div id="posicionDivField"><label for="posicionField">Posició (més precisió)</label><input readonly="true" placeholder="Clic para desplegar mapa" type="text" id="posicionField" name="posicionField" /></div>
                <label>Selecciona el ZIP de la vista 360º generat amb el KRPANO:</label><div id="zipFileField"><input accept="application/zip" type="file" id="fileField" name="fileField" /></div>

                <label for="telefonoField">Telefon</label><input type="text" id="telefonoField" name="telefonoField" />
                <label for="emailField">E-mail</label><input type="text" id="emailField" name="emailField" />
                <label for="siteField">Web</label><input type="text" id="siteField" name="siteField" />
               <br/> <button id="addPOINou" class="btn btn-success"><i class="icol-layer-treansparent"></i> Afegir</button>
            </div>
         </div>
</div>
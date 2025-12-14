<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GameZone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 20px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .section-title {
            font-size: 24px;
            color: #333;
        }

        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .card.clickable {
            cursor: pointer;
        }

        .card-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: none;
            gap: 5px;
        }

        .card.editable:hover .card-actions {
            display: flex;
        }

        .btn-edit, .btn-delete {
            background: white;
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-edit {
            color: #667eea;
            border-color: #667eea;
        }

        .btn-edit:hover {
            background: #667eea;
            color: white;
        }

        .btn-delete {
            color: #ff6b6b;
            border-color: #ff6b6b;
        }

        .btn-delete:hover {
            background: #ff6b6b;
            color: white;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            padding-right: 60px;
        }

        .card-text {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .card-text p {
            margin-bottom: 8px;
        }

        .badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 12px;
            margin-top: 10px;
        }

        .user-profile {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #333;
            width: 150px;
        }

        .detail-value {
            color: #666;
        }

        .role-badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-badge.admin {
            background: #ff6b6b;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: white;
            margin: 2% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close:hover {
            color: #000;
        }

        .modal-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
        }

        .modal-header h2 {
            color: #333;
            font-size: 22px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            margin-bottom: 0;
            cursor: pointer;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin: 0;
            cursor: pointer;
        }

        .form-group.multi-select {
            position: relative;
        }

        .multi-select-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background: white;
            max-height: 250px;
            overflow-y: auto;
        }

        .multi-select-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
            transition: background 0.2s;
            margin-bottom: 5px;
            border: 1px solid #eee;
        }

        .multi-select-item:hover {
            background: #f0f0f0;
            border-color: #667eea;
        }

        .multi-select-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin: 0;
            margin-right: 10px;
            cursor: pointer;
        }

        .multi-select-item span {
            flex: 1;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-delete-modal {
            width: 100%;
            padding: 12px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: transform 0.2s, background 0.2s;
        }

        .btn-delete-modal:hover {
            background: #ff5252;
            transform: translateY(-2px);
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }

        .alert.error {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert.success {
            background-color: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }

        .loading {
            display: none;
            text-align: center;
            color: #667eea;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .button-group button {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🎮 GameZone</h1>
        <div class="user-info">
            <span id="userName">Cargando...</span>
            <button class="btn-logout" onclick="logout()">Cerrar Sesión</button>
        </div>
    </div>

    <div class="container">
        <!-- Perfil de Usuario -->
        <div class="user-profile">
            <h2 style="margin-bottom: 20px; color: #333;">Mi Perfil</h2>
            <div class="detail-row">
                <div class="detail-label">Nombre:</div>
                <div class="detail-value" id="detailName">-</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Correo:</div>
                <div class="detail-value" id="detailEmail">-</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Rol:</div>
                <div class="detail-value">
                    <span class="role-badge" id="detailRole">-</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Registrado:</div>
                <div class="detail-value" id="detailCreated">-</div>
            </div>
        </div>

        <!-- Sección de Juegos -->
        <div class="section">
            <div class="section-header">
                <h3 class="section-title">🎮 Juegos Disponibles</h3>
                <button id="btnAddJuego" class="btn-add" style="display: none;" onclick="openModalAgregar()">+ Agregar Juego</button>
            </div>
            <div id="juegosContainer" class="grid"></div>
        </div>

        <!-- Sección de Plataformas -->
        <div class="section">
            <h3 class="section-title">🖥️ Plataformas</h3>
            <div id="plataformasContainer" class="grid"></div>
        </div>

        <!-- Sección de Géneros -->
        <div class="section">
            <h3 class="section-title">🏷️ Géneros</h3>
            <div id="generosContainer" class="grid"></div>
        </div>
    </div>

    <!-- Modal para mostrar juegos filtrados -->
    <div id="modalJuegosFiltrados" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModalFiltrados()">&times;</span>
                <h2 id="filtroTitle">Juegos</h2>
            </div>

            <div id="juegosFiltradosContainer" class="grid"></div>
        </div>
    </div>
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModalJuego()">&times;</span>
                <h2 id="modalTitle">Agregar Nuevo Juego</h2>
            </div>

            <div id="modalAlert" class="alert"></div>

            <form id="formJuego">
                <div class="form-group">
                    <label for="juegoTitulo">Título *</label>
                    <input type="text" id="juegoTitulo" name="titulo" required>
                </div>

                <div class="form-group">
                    <label for="juegoDescripcionCorta">Descripción Corta</label>
                    <textarea id="juegoDescripcionCorta" name="descripcion_corta"></textarea>
                </div>

                <div class="form-group">
                    <label for="juegoDescripcionLarga">Descripción Larga</label>
                    <textarea id="juegoDescripcionLarga" name="descripcion_larga"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="juegoPrecioNormal">Precio Normal *</label>
                        <input type="number" id="juegoPrecioNormal" name="precio_normal" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="juegoPrecioOferta">Precio Oferta</label>
                        <input type="number" id="juegoPrecioOferta" name="precio_oferta" step="0.01">
                    </div>
                </div>

                <div class="form-group">
                    <label for="juegoPlataforma">Plataforma *</label>
                    <select id="juegoPlataforma" name="plataforma_id" required>
                        <option value="">Selecciona una plataforma...</option>
                    </select>
                </div>

                <div class="form-group multi-select">
                    <label>Géneros</label>
                    <div class="multi-select-box" id="generosSelectBox"></div>
                </div>

                <div class="form-group">
                    <label for="juegoImagenUrl">URL de Imagen</label>
                    <input type="url" id="juegoImagenUrl" name="imagen_url" placeholder="https://ejemplo.com/imagen.jpg">
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" id="juegoDestacado" name="destacado">
                        <span>Juego Destacado</span>
                    </label>
                    <label>
                        <input type="checkbox" id="juegoActivo" name="activo" checked>
                        <span>Activo</span>
                    </label>
                </div>

                <div class="loading" id="juegoLoading">
                    <div class="spinner"></div>
                    <span>Guardando juego...</span>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-submit" id="juegoSubmitBtn">Guardar Juego</button>
                    <button type="button" class="btn-delete-modal" id="juegoDeleteBtn" style="display: none;" onclick="deleteJuego()">Eliminar Juego</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const authToken = localStorage.getItem('sanctum_token');
        const userDataStr = localStorage.getItem('user_data');

        if (!authToken || !userDataStr) {
            window.location.href = '/login';
        }

        let currentUser = null;
        let plataformasData = [];
        let generosData = [];
        let editingJuegoId = null;

        document.addEventListener('DOMContentLoaded', function() {
            try {
                currentUser = JSON.parse(userDataStr);

                document.getElementById('userName').textContent = currentUser.name;
                document.getElementById('detailName').textContent = currentUser.name;
                document.getElementById('detailEmail').textContent = currentUser.email;
                
                const roleElement = document.getElementById('detailRole');
                roleElement.textContent = (currentUser.role || 'usuario').toUpperCase();
                if (currentUser.role === 'admin') {
                    roleElement.classList.add('admin');
                    document.getElementById('btnAddJuego').style.display = 'block';
                }

                if (currentUser.created_at) {
                    const createdDate = new Date(currentUser.created_at);
                    document.getElementById('detailCreated').textContent = createdDate.toLocaleDateString('es-ES');
                }

                loadJuegos();
                loadPlataformas();
                loadGeneros();
            } catch (error) {
                console.error('Error al cargar datos:', error);
                localStorage.removeItem('sanctum_token');
                localStorage.removeItem('user_data');
                window.location.href = '/login';
            }
        });

        function openModalAgregar() {
            editingJuegoId = null;
            document.getElementById('modalTitle').textContent = 'Agregar Nuevo Juego';
            document.getElementById('juegoDeleteBtn').style.display = 'none';
            document.getElementById('modalJuego').style.display = 'block';
            document.getElementById('modalAlert').style.display = 'none';
            document.getElementById('formJuego').reset();
            loadPlataformasForForm();
            loadGenerosForForm();
        }

        async function openModalEditar(juegoId) {
            editingJuegoId = juegoId;
            document.getElementById('modalTitle').textContent = 'Editar Juego';
            document.getElementById('juegoDeleteBtn').style.display = 'block';
            document.getElementById('modalJuego').style.display = 'block';
            document.getElementById('modalAlert').style.display = 'none';
            await loadPlataformasForForm();
            await loadGenerosForForm();
            await cargarJuegoEnFormulario(juegoId);
        }

        function closeModalJuego() {
            document.getElementById('modalJuego').style.display = 'none';
            document.getElementById('formJuego').reset();
            document.getElementById('modalAlert').style.display = 'none';
            editingJuegoId = null;
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalJuego');
            if (event.target == modal) {
                closeModalJuego();
            }
        }

        async function cargarJuegoEnFormulario(juegoId) {
            try {
                const response = await fetch(`/api/juegos/${juegoId}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();
                
                if (!response.ok || !result.success) {
                    showModalAlert('Error: No se pudo cargar el juego', 'error');
                    return;
                }

                const juego = result.data;
                
                console.log('Juego cargado:', juego);

                // Esperar un pequeño delay para asegurar que los selectores están listos
                await new Promise(resolve => setTimeout(resolve, 150));

                // Rellenar campos de texto
                document.getElementById('juegoTitulo').value = juego.titulo || '';
                document.getElementById('juegoDescripcionCorta').value = juego.descripcion_corta || '';
                document.getElementById('juegoDescripcionLarga').value = juego.descripcion_larga || '';
                document.getElementById('juegoPrecioNormal').value = juego.precio_normal || '';
                document.getElementById('juegoPrecioOferta').value = juego.precio_oferta || '';
                document.getElementById('juegoImagenUrl').value = juego.imagen_url || '';
                document.getElementById('juegoDestacado').checked = !!juego.destacado;
                document.getElementById('juegoActivo').checked = !!juego.activo;

                // Seleccionar plataforma
                const plataformaSelect = document.getElementById('juegoPlataforma');
                if (juego.plataforma && juego.plataforma.id) {
                    plataformaSelect.value = juego.plataforma.id;
                    console.log('Plataforma seleccionada:', juego.plataforma.id);
                } else if (juego.plataforma_id) {
                    plataformaSelect.value = juego.plataforma_id;
                    console.log('Plataforma seleccionada (por ID):', juego.plataforma_id);
                }

                // Marcar géneros seleccionados
                const generosIds = juego.generos && juego.generos.length > 0 
                    ? juego.generos.map(g => g.id) 
                    : [];
                
                console.log('Géneros a marcar:', generosIds);
                
                const checkboxes = document.querySelectorAll('input[name="generos[]"]');
                checkboxes.forEach(checkbox => {
                    const checkboxId = parseInt(checkbox.value);
                    const shouldBeChecked = generosIds.includes(checkboxId);
                    checkbox.checked = shouldBeChecked;
                    console.log(`Checkbox ${checkboxId}: ${shouldBeChecked}`);
                });

            } catch (error) {
                console.error('Error al cargar juego:', error);
                showModalAlert('Error de conexión al cargar el juego', 'error');
            }
        }

        async function loadPlataformasForForm() {
            try {
                const response = await fetch('/api/plataformas', {
                    headers: { 'Accept': 'application/json' }
                });
                const result = await response.json();
                plataformasData = result.data || result;

                const select = document.getElementById('juegoPlataforma');
                select.innerHTML = '<option value="">Selecciona una plataforma...</option>';
                
                plataformasData.forEach(plataforma => {
                    const option = document.createElement('option');
                    option.value = plataforma.id;
                    option.textContent = plataforma.nombre;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error al cargar plataformas:', error);
            }
        }

        async function loadGenerosForForm() {
            try {
                const response = await fetch('/api/generos', {
                    headers: { 'Accept': 'application/json' }
                });
                const result = await response.json();
                
                generosData = Array.isArray(result) ? result : (result.data || []);

                const box = document.getElementById('generosSelectBox');
                box.innerHTML = '';
                
                if (generosData.length === 0) {
                    box.innerHTML = '<p style="padding: 10px; color: #999; text-align: center;">No hay géneros disponibles</p>';
                    return;
                }
                
                generosData.forEach(genero => {
                    const label = document.createElement('label');
                    label.className = 'multi-select-item';
                    
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'generos[]';
                    checkbox.value = genero.id;
                    
                    const span = document.createElement('span');
                    span.textContent = `${genero.nombre} (ID: ${genero.id})`;
                    
                    label.appendChild(checkbox);
                    label.appendChild(span);
                    box.appendChild(label);
                });
            } catch (error) {
                console.error('Error al cargar géneros:', error);
            }
        }

        document.getElementById('formJuego').addEventListener('submit', async function(e) {
            e.preventDefault();

            const titulo = document.getElementById('juegoTitulo').value.trim();
            const descripcionCorta = document.getElementById('juegoDescripcionCorta').value.trim();
            const descripcionLarga = document.getElementById('juegoDescripcionLarga').value.trim();
            const precioNormal = parseFloat(document.getElementById('juegoPrecioNormal').value);
            const precioOferta = document.getElementById('juegoPrecioOferta').value ? parseFloat(document.getElementById('juegoPrecioOferta').value) : null;
            const plataformaId = document.getElementById('juegoPlataforma').value;
            const imagenUrl = document.getElementById('juegoImagenUrl').value.trim();
            const destacado = document.getElementById('juegoDestacado').checked;
            const activo = document.getElementById('juegoActivo').checked;

            const generosSeleccionados = [];
            document.querySelectorAll('input[name="generos[]"]:checked').forEach(checkbox => {
                const generoId = parseInt(checkbox.value);
                if (!isNaN(generoId) && generoId > 0) {
                    generosSeleccionados.push(generoId);
                }
            });

            if (!titulo || !plataformaId || !precioNormal) {
                showModalAlert('Por favor completa los campos requeridos', 'error');
                return;
            }

            if (precioOferta && precioOferta >= precioNormal) {
                showModalAlert('El precio de oferta debe ser menor al precio normal', 'error');
                return;
            }

            document.getElementById('juegoLoading').style.display = 'block';
            document.getElementById('juegoSubmitBtn').disabled = true;

            try {
                const payload = {
                    titulo: titulo,
                    descripcion_corta: descripcionCorta || null,
                    descripcion_larga: descripcionLarga || null,
                    precio_normal: precioNormal,
                    precio_oferta: precioOferta,
                    imagen_url: imagenUrl || null,
                    destacado: destacado,
                    activo: activo,
                    plataforma_id: parseInt(plataformaId),
                    generos: generosSeleccionados
                };

                const method = editingJuegoId ? 'PUT' : 'POST';
                const url = editingJuegoId ? `/api/juegos/${editingJuegoId}` : '/api/juegos';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    const mensaje = editingJuegoId ? '¡Juego actualizado exitosamente!' : '¡Juego agregado exitosamente!';
                    showModalAlert(mensaje, 'success');
                    setTimeout(() => {
                        closeModalJuego();
                        loadJuegos();
                    }, 1000);
                } else {
                    showModalAlert(data.message || 'Error al guardar el juego', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showModalAlert('Error de conexión. Intenta nuevamente.', 'error');
            } finally {
                document.getElementById('juegoLoading').style.display = 'none';
                document.getElementById('juegoSubmitBtn').disabled = false;
            }
        });

        async function deleteJuego() {
            if (!editingJuegoId || !confirm('¿Estás seguro de que quieres eliminar este juego?')) {
                return;
            }

            document.getElementById('juegoLoading').style.display = 'block';
            document.getElementById('juegoDeleteBtn').disabled = true;

            try {
                const response = await fetch(`/api/juegos/${editingJuegoId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showModalAlert('¡Juego eliminado exitosamente!', 'success');
                    setTimeout(() => {
                        closeModalJuego();
                        loadJuegos();
                    }, 1000);
                } else {
                    showModalAlert(data.message || 'Error al eliminar el juego', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showModalAlert('Error de conexión. Intenta nuevamente.', 'error');
            } finally {
                document.getElementById('juegoLoading').style.display = 'none';
                document.getElementById('juegoDeleteBtn').disabled = false;
            }
        }

        function showModalAlert(message, type) {
            const alertDiv = document.getElementById('modalAlert');
            alertDiv.textContent = message;
            alertDiv.className = 'alert ' + type;
            alertDiv.style.display = 'block';
        }

        async function loadJuegos() {
            try {
                const response = await fetch('/api/juegos', {
                    headers: { 'Accept': 'application/json' }
                });
                const result = await response.json();

                const container = document.getElementById('juegosContainer');
                const juegos = result.data || result;
                
                if (Array.isArray(juegos) && juegos.length > 0) {
                    container.innerHTML = juegos.map(juego => `
                        <div class="card ${currentUser.role === 'admin' ? 'editable' : ''}">
                            ${currentUser.role === 'admin' ? `
                                <div class="card-actions">
                                    <button class="btn-edit" onclick="openModalEditar(${juego.id})">Editar</button>
                                </div>
                            ` : ''}
                            <div class="card-title">${juego.titulo || 'Sin título'}</div>
                            <div class="card-text">
                                ${juego.descripcion_corta ? `<p><strong>Descripción:</strong> ${juego.descripcion_corta}</p>` : ''}
                                ${juego.precio_normal ? `<p><strong>Precio:</strong> $${parseFloat(juego.precio_normal).toFixed(2)}</p>` : ''}
                                ${juego.plataforma ? `<p><strong>Plataforma:</strong> ${juego.plataforma.nombre}</p>` : ''}
                                ${juego.generos && juego.generos.length > 0 ? `<p><strong>Géneros:</strong> ${juego.generos.map(g => g.nombre).join(', ')}</p>` : ''}
                            </div>
                            <div class="badge">ID: ${juego.id}</div>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div class="empty-state">No hay juegos disponibles</div>';
                }
            } catch (error) {
                console.error('Error al cargar juegos:', error);
                document.getElementById('juegosContainer').innerHTML = '<div class="empty-state">Error al cargar los juegos</div>';
            }
        }

        async function loadPlataformas() {
            try {
                const response = await fetch('/api/plataformas', {
                    headers: { 'Accept': 'application/json' }
                });
                const result = await response.json();

                const container = document.getElementById('plataformasContainer');
                const plataformas = result.data || result;
                
                if (Array.isArray(plataformas) && plataformas.length > 0) {
                    container.innerHTML = plataformas.map(plataforma => `
                        <div class="card" onclick="filtrarPorPlataforma(${plataforma.id}, '${plataforma.nombre.replace(/'/g, "\\'")}')">
                            <div class="card-title">${plataforma.nombre}</div>
                            <div class="card-text">
                                ${plataforma.descripcion ? `<p>${plataforma.descripcion}</p>` : '<p>Sin descripción</p>'}
                            </div>
                            <div class="badge">${plataforma.slug || 'Plataforma'}</div>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div class="empty-state">No hay plataformas disponibles</div>';
                }
            } catch (error) {
                console.error('Error al cargar plataformas:', error);
                document.getElementById('plataformasContainer').innerHTML = '<div class="empty-state">Error al cargar las plataformas</div>';
            }
        }

        async function loadGeneros() {
            try {
                const response = await fetch('/api/generos', {
                    headers: { 'Accept': 'application/json' }
                });
                const result = await response.json();

                const container = document.getElementById('generosContainer');
                const generos = result.data || result;
                
                if (Array.isArray(generos) && generos.length > 0) {
                    container.innerHTML = generos.map(genero => `
                        <div class="card">
                            <div class="card-title">${genero.nombre}</div>
                            <div class="card-text">
                                ${genero.descripcion ? `<p>${genero.descripcion}</p>` : '<p>Sin descripción</p>'}
                            </div>
                            <div class="badge">Género</div>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div class="empty-state">No hay géneros disponibles</div>';
                }
            } catch (error) {
                console.error('Error al cargar géneros:', error);
                document.getElementById('generosContainer').innerHTML = '<div class="empty-state">Error al cargar los géneros</div>';
            }
        }

        async function logout() {
            const token = localStorage.getItem('sanctum_token');

            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.error('Error al cerrar sesión:', error);
            } finally {
                localStorage.removeItem('sanctum_token');
                localStorage.removeItem('user_data');
                window.location.href = '/login';
            }
        }
    </script>
</body>
</html>

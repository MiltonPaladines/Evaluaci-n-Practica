<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GameZone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
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

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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
            margin-bottom: 15px;
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

        .auth-container {
            display: flex;
            gap: 20px;
            align-items: stretch;
        }

        .auth-form {
            flex: 1;
        }

        .toggle-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .toggle-link a {
            color: #667eea;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        .toggle-link a:hover {
            text-decoration: underline;
        }

        .form-hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="login-header">
                <h1>🎮 GameZone</h1>
                <p id="headerText">Inicia sesión para continuar</p>
            </div>

            <div id="alert" class="alert"></div>

            <!-- Formulario de Login -->
            <div id="loginForm" class="auth-form">
                <form id="loginFormElement">
                    <div class="form-group">
                        <label for="loginEmail">Correo Electrónico</label>
                        <input 
                            type="email" 
                            id="loginEmail" 
                            name="email" 
                            placeholder="tu@correo.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="loginPassword">Contraseña</label>
                        <input 
                            type="password" 
                            id="loginPassword" 
                            name="password" 
                            placeholder="Ingresa tu contraseña"
                            required
                        >
                    </div>

                    <div class="loading" id="loginLoading">
                        <div class="spinner"></div>
                        <span>Iniciando sesión...</span>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        Iniciar Sesión
                    </button>
                </form>

                <div class="toggle-link">
                    ¿No tienes cuenta? <a onclick="toggleForms()">Registrarse</a>
                </div>
            </div>

            <!-- Formulario de Registro -->
            <div id="registerForm" class="auth-form form-hidden">
                <form id="registerFormElement">
                    <div class="form-group">
                        <label for="registerName">Nombre Completo</label>
                        <input 
                            type="text" 
                            id="registerName" 
                            name="name" 
                            placeholder="Tu nombre"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="registerEmail">Correo Electrónico</label>
                        <input 
                            type="email" 
                            id="registerEmail" 
                            name="email" 
                            placeholder="tu@correo.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="registerPassword">Contraseña</label>
                        <input 
                            type="password" 
                            id="registerPassword" 
                            name="password" 
                            placeholder="Mínimo 6 caracteres"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="registerPasswordConfirm">Confirmar Contraseña</label>
                        <input 
                            type="password" 
                            id="registerPasswordConfirm" 
                            name="password_confirmation" 
                            placeholder="Confirma tu contraseña"
                            required
                        >
                    </div>

                    <div class="loading" id="registerLoading">
                        <div class="spinner"></div>
                        <span>Registrando usuario...</span>
                    </div>

                    <button type="submit" class="btn-login" id="registerBtn">
                        Registrarse
                    </button>
                </form>

                <div class="toggle-link">
                    ¿Ya tienes cuenta? <a onclick="toggleForms()">Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle entre login y registro
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const headerText = document.getElementById('headerText');
            const alertDiv = document.getElementById('alert');

            loginForm.classList.toggle('form-hidden');
            registerForm.classList.toggle('form-hidden');

            if (loginForm.classList.contains('form-hidden')) {
                headerText.textContent = 'Crear nueva cuenta';
            } else {
                headerText.textContent = 'Inicia sesión para continuar';
            }

            // Limpiar alerta
            alertDiv.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Formulario de Login
            const loginFormElement = document.getElementById('loginFormElement');
            const loginEmailInput = document.getElementById('loginEmail');
            const loginPasswordInput = document.getElementById('loginPassword');
            const loginBtn = document.getElementById('loginBtn');
            const loginLoading = document.getElementById('loginLoading');

            // Formulario de Registro
            const registerFormElement = document.getElementById('registerFormElement');
            const registerNameInput = document.getElementById('registerName');
            const registerEmailInput = document.getElementById('registerEmail');
            const registerPasswordInput = document.getElementById('registerPassword');
            const registerPasswordConfirmInput = document.getElementById('registerPasswordConfirm');
            const registerBtn = document.getElementById('registerBtn');
            const registerLoading = document.getElementById('registerLoading');

            const alertDiv = document.getElementById('alert');

            // ===== MANEJO DE LOGIN =====
            loginFormElement.addEventListener('submit', async function(e) {
                e.preventDefault();

                const email = loginEmailInput.value.trim();
                const password = loginPasswordInput.value;

                if (!email || !password) {
                    showAlert('Por favor completa todos los campos', 'error');
                    return;
                }

                loginLoading.style.display = 'block';
                loginBtn.disabled = true;
                alertDiv.style.display = 'none';

                try {
                    const response = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            email: email,
                            password: password
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        localStorage.setItem('sanctum_token', data.data.token);
                        localStorage.setItem('user_data', JSON.stringify(data.data.user));

                        showAlert('¡Bienvenido ' + data.data.user.name + '!', 'success');

                        setTimeout(() => {
                            window.location.replace('/dashboard');
                        }, 500);
                    } else {
                        showAlert(data.message || 'Credenciales inválidas', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showAlert('Error de conexión. Intenta nuevamente.', 'error');
                } finally {
                    loginLoading.style.display = 'none';
                    loginBtn.disabled = false;
                }
            });

            // ===== MANEJO DE REGISTRO =====
            registerFormElement.addEventListener('submit', async function(e) {
                e.preventDefault();

                const name = registerNameInput.value.trim();
                const email = registerEmailInput.value.trim();
                const password = registerPasswordInput.value;
                const passwordConfirm = registerPasswordConfirmInput.value;

                if (!name || !email || !password || !passwordConfirm) {
                    showAlert('Por favor completa todos los campos', 'error');
                    return;
                }

                if (password !== passwordConfirm) {
                    showAlert('Las contraseñas no coinciden', 'error');
                    return;
                }

                if (password.length < 6) {
                    showAlert('La contraseña debe tener mínimo 6 caracteres', 'error');
                    return;
                }

                registerLoading.style.display = 'block';
                registerBtn.disabled = true;
                alertDiv.style.display = 'none';

                try {
                    const response = await fetch('/api/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            name: name,
                            email: email,
                            password: password,
                            password_confirmation: passwordConfirm,
                            role: 'user'
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        localStorage.setItem('sanctum_token', data.data.token);
                        localStorage.setItem('user_data', JSON.stringify(data.data.user));

                        showAlert('¡Bienvenido ' + data.data.user.name + '! Usuario creado exitosamente.', 'success');

                        setTimeout(() => {
                            window.location.replace('/dashboard');
                        }, 500);
                    } else {
                        showAlert(data.message || 'Error al registrar usuario', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showAlert('Error de conexión. Intenta nuevamente.', 'error');
                } finally {
                    registerLoading.style.display = 'none';
                    registerBtn.disabled = false;
                }
            });

            function showAlert(message, type) {
                alertDiv.textContent = message;
                alertDiv.className = 'alert ' + type;
                alertDiv.style.display = 'block';
            }

            // Limpiar errores al escribir en login
            loginEmailInput.addEventListener('input', function() {
                if (alertDiv.classList.contains('error')) {
                    alertDiv.style.display = 'none';
                }
            });

            loginPasswordInput.addEventListener('input', function() {
                if (alertDiv.classList.contains('error')) {
                    alertDiv.style.display = 'none';
                }
            });

            // Limpiar errores al escribir en registro
            registerNameInput.addEventListener('input', function() {
                if (alertDiv.classList.contains('error')) {
                    alertDiv.style.display = 'none';
                }
            });

            registerEmailInput.addEventListener('input', function() {
                if (alertDiv.classList.contains('error')) {
                    alertDiv.style.display = 'none';
                }
            });

            registerPasswordInput.addEventListener('input', function() {
                if (alertDiv.classList.contains('error')) {
                    alertDiv.style.display = 'none';
                }
            });

            registerPasswordConfirmInput.addEventListener('input', function() {
                if (alertDiv.classList.contains('error')) {
                    alertDiv.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>

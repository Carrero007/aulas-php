<?php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>API CEP</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            padding: 30px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #2c3e50;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            font-size: 18px;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            color: #2c3e50;
        }

        .card h2 .badge {
            display: inline-block;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 4px;
            margin-right: 8px;
            font-weight: bold;
            color: #fff;
        }

        .badge-get    { background: #27ae60; }
        .badge-post   { background: #2980b9; }
        .badge-put    { background: #e67e22; }
        .badge-delete { background: #e74c3c; }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 10px;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #2980b9;
        }

        input[readonly] {
            background: #f9f9f9;
            color: #888;
            cursor: not-allowed;
        }

        .btn-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        button:hover { opacity: 0.85; }

        .btn-primary  { background: #2980b9; color: #fff; }
        .btn-success  { background: #27ae60; color: #fff; }
        .btn-warning  { background: #e67e22; color: #fff; }
        .btn-danger   { background: #e74c3c; color: #fff; }
        .btn-secondary { background: #7f8c8d; color: #fff; }

        .field-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 12px;
        }

        .field-group .full-width {
            grid-column: 1 / -1;
        }

        #put-fields {
            display: none;
            margin-top: 12px;
        }

        #resposta-wrapper {
            background: #fff;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        #resposta-wrapper h2 {
            font-size: 18px;
            margin-bottom: 12px;
            color: #2c3e50;
        }

        #resposta {
            background: #1e272e;
            color: #a8e6cf;
            padding: 16px;
            border-radius: 6px;
            font-size: 13px;
            line-height: 1.6;
            min-height: 60px;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .msg-erro  { color: #e74c3c; font-size: 13px; margin-top: -6px; margin-bottom: 8px; }
        .msg-info  { color: #2980b9; font-size: 13px; margin-top: -6px; margin-bottom: 8px; }

        label {
            font-size: 12px;
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 4px;
        }

        .input-wrapper { margin-bottom: 10px; }
    </style>
</head>
<body>

<h1>📮 API de CEP</h1>

<div class="container">

    <!-- GET -->
    <div class="card">
        <h2><span class="badge badge-get">GET</span> Consultar CEP</h2>
        <div class="input-wrapper">
            <label>CEP</label>
            <input type="text" id="get-cep" placeholder="Ex: 01310100" maxlength="9">
        </div>
        <button class="btn-success" onclick="buscarCep()">🔍 Buscar</button>
    </div>

    <!-- POST -->
    <div class="card">
        <h2><span class="badge badge-post">POST</span> Cadastrar CEP</h2>
        <div class="input-wrapper">
            <label>CEP</label>
            <input type="text" id="post-cep" placeholder="Ex: 01310100" maxlength="9">
        </div>
        <div class="btn-row" style="margin-bottom:12px;">
            <button class="btn-secondary" onclick="preencherViaCep()">🌐 Buscar via ViaCEP</button>
        </div>
        <div class="field-group">
            <div class="input-wrapper full-width">
                <label>Logradouro</label>
                <input type="text" id="post-logradouro" placeholder="Logradouro">
            </div>
            <div class="input-wrapper">
                <label>Bairro</label>
                <input type="text" id="post-bairro" placeholder="Bairro">
            </div>
            <div class="input-wrapper">
                <label>Cidade</label>
                <input type="text" id="post-cidade" placeholder="Cidade">
            </div>
            <div class="input-wrapper">
                <label>Estado (UF)</label>
                <input type="text" id="post-estado" placeholder="Ex: SP" maxlength="2">
            </div>
            <div class="input-wrapper">
                <label>País</label>
                <input type="text" id="post-pais" placeholder="Brasil">
            </div>
        </div>
        <button class="btn-primary" onclick="cadastrarCep()">💾 Cadastrar</button>
    </div>

    <!-- PUT -->
    <div class="card">
        <h2><span class="badge badge-put">PUT</span> Atualizar CEP</h2>
        <div class="input-wrapper">
            <label>CEP a atualizar</label>
            <input type="text" id="put-cep" placeholder="Ex: 01310100" maxlength="9">
        </div>
        <div id="put-msg"></div>
        <div class="btn-row" style="margin-bottom:4px;">
            <button class="btn-secondary" onclick="localizarCepParaAtualizar()">🔍 Localizar CEP</button>
        </div>

        <!-- campos só aparecem depois de localizar -->
        <div id="put-fields">
            <hr style="margin: 16px 0; border-color: #eee;">
            <div class="field-group">
                <div class="input-wrapper full-width">
                    <label>Logradouro</label>
                    <input type="text" id="put-logradouro" placeholder="Logradouro">
                </div>
                <div class="input-wrapper">
                    <label>Bairro</label>
                    <input type="text" id="put-bairro" placeholder="Bairro">
                </div>
                <div class="input-wrapper">
                    <label>Cidade</label>
                    <input type="text" id="put-cidade" placeholder="Cidade">
                </div>
                <div class="input-wrapper">
                    <label>Estado (UF)</label>
                    <input type="text" id="put-estado" placeholder="Ex: SP" maxlength="2">
                </div>
                <div class="input-wrapper">
                    <label>País</label>
                    <input type="text" id="put-pais" placeholder="Brasil">
                </div>
            </div>
            <button class="btn-warning" onclick="atualizarCep()">✏️ Atualizar</button>
        </div>
    </div>

    <!-- DELETE -->
    <div class="card">
        <h2><span class="badge badge-delete">DELETE</span> Remover CEP</h2>
        <div class="input-wrapper">
            <label>CEP</label>
            <input type="text" id="delete-cep" placeholder="Ex: 01310100" maxlength="9">
        </div>
        <button class="btn-danger" onclick="removerCep()">🗑️ Remover</button>
    </div>

    <!-- RESPOSTA -->
    <div id="resposta-wrapper">
        <h2>📋 Resposta</h2>
        <pre id="resposta">Aguardando requisição...</pre>
    </div>

</div>

<script>
    const API = 'api/cep.php';

    function mostrarResposta(dados) {
        document.getElementById('resposta').textContent = JSON.stringify(dados, null, 2);
    }

    // ---- GET ----
    async function buscarCep() {
        const cep = document.getElementById('get-cep').value;
        const res = await fetch(API + '?cep=' + cep);
        mostrarResposta(await res.json());
    }

    // ---- POST ----
    async function preencherViaCep() {
        const cep = document.getElementById('post-cep').value.replace(/\D/g, '');
        if (cep.length !== 8) { alert('Digite um CEP válido com 8 dígitos.'); return; }

        const res = await fetch('https://viacep.com.br/ws/' + cep + '/json/');
        const dados = await res.json();

        if (dados.erro) { alert('CEP não encontrado no ViaCEP.'); return; }

        document.getElementById('post-logradouro').value = dados.logradouro || '';
        document.getElementById('post-bairro').value     = dados.bairro     || '';
        document.getElementById('post-cidade').value     = dados.localidade || '';
        document.getElementById('post-estado').value     = dados.uf         || '';
        document.getElementById('post-pais').value       = 'Brasil';
    }

    async function cadastrarCep() {
        const body = {
            cep:        document.getElementById('post-cep').value,
            logradouro: document.getElementById('post-logradouro').value,
            bairro:     document.getElementById('post-bairro').value,
            cidade:     document.getElementById('post-cidade').value,
            estado:     document.getElementById('post-estado').value,
            pais:       document.getElementById('post-pais').value
        };
        const res = await fetch(API, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });
        mostrarResposta(await res.json());
    }

    // ---- PUT ----
    async function localizarCepParaAtualizar() {
        const cep = document.getElementById('put-cep').value.replace(/\D/g, '');
        const msgEl = document.getElementById('put-msg');
        const fieldsEl = document.getElementById('put-fields');

        msgEl.innerHTML = '';
        fieldsEl.style.display = 'none';

        if (cep.length !== 8) {
            msgEl.innerHTML = '<p class="msg-erro">⚠️ Digite um CEP válido com 8 dígitos.</p>';
            return;
        }

        msgEl.innerHTML = '<p class="msg-info">🔄 Buscando...</p>';

        const res = await fetch(API + '?cep=' + cep);
        const dados = await res.json();

        if (dados.erro) {
            msgEl.innerHTML = '<p class="msg-erro">❌ CEP não encontrado na base. Só é possível atualizar CEPs já cadastrados.</p>';
            return;
        }

        // preenche os campos com os dados atuais
        document.getElementById('put-logradouro').value = dados.logradouro || '';
        document.getElementById('put-bairro').value     = dados.bairro     || '';
        document.getElementById('put-cidade').value     = dados.cidade     || '';
        document.getElementById('put-estado').value     = dados.estado     || '';
        document.getElementById('put-pais').value       = dados.pais       || '';

        msgEl.innerHTML = '<p class="msg-info">✅ CEP encontrado! Altere os campos abaixo.</p>';
        fieldsEl.style.display = 'block';
    }

    async function atualizarCep() {
        const body = {
            cep:        document.getElementById('put-cep').value,
            logradouro: document.getElementById('put-logradouro').value,
            bairro:     document.getElementById('put-bairro').value,
            cidade:     document.getElementById('put-cidade').value,
            estado:     document.getElementById('put-estado').value,
            pais:       document.getElementById('put-pais').value
        };
        const res = await fetch(API, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });
        const dados = await res.json();
        mostrarResposta(dados);

        if (!dados.erro) {
            document.getElementById('put-fields').style.display = 'none';
            document.getElementById('put-msg').innerHTML = '';
            document.getElementById('put-cep').value = '';
        }
    }

    // ---- DELETE ----
    async function removerCep() {
        const cep = document.getElementById('delete-cep').value;
        const res = await fetch(API + '?cep=' + cep, { method: 'DELETE' });
        mostrarResposta(await res.json());
    }
</script>

</body>
</html>

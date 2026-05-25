<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>API CEP</title>
</head>
<body>

<h1>API de CEP</h1>

<h2>GET - Consultar CEP</h2>
<input type="text" id="get-cep" placeholder="Digite o CEP">
<button onclick="buscarCep()">Buscar</button>

<h2>POST - Cadastrar CEP</h2>
<input type="text" id="post-cep" placeholder="CEP">
<button onclick="preencherViaCep()">Buscar CEP</button><br>
<input type="text" id="post-logradouro" placeholder="Logradouro"><br>
<input type="text" id="post-bairro" placeholder="Bairro"><br>
<input type="text" id="post-cidade" placeholder="Cidade"><br>
<input type="text" id="post-estado" placeholder="Estado"><br>
<input type="text" id="post-pais" placeholder="País"><br>
<button onclick="cadastrarCep()">Cadastrar</button>

<h2>PUT - Atualizar CEP</h2>
<input type="text" id="put-cep" placeholder="CEP" readonly><br>
<input type="text" id="put-logradouro" placeholder="Logradouro"><br>
<input type="text" id="put-bairro" placeholder="Bairro"><br>
<input type="text" id="put-cidade" placeholder="Cidade"><br>
<input type="text" id="put-estado" placeholder="Estado"><br>
<input type="text" id="put-pais" placeholder="País"><br>
<button onclick="atualizarCep()">Atualizar</button>

<h2>DELETE - Remover CEP</h2>
<input type="text" id="delete-cep" placeholder="Digite o CEP">
<button onclick="removerCep()">Remover</button>

<h2>Resposta:</h2>
<pre id="resposta"></pre>

<script>
    const API = 'api/cep.php';

    async function buscarCep() {
        const cep = document.getElementById('get-cep').value;
        const res = await fetch(API + '?cep=' + cep);
        const dados = await res.json();
        document.getElementById('resposta').textContent = JSON.stringify(dados, null, 2);
    }

    async function preencherViaCep() {
        const cep = document.getElementById('post-cep').value;
        const res = await fetch('https://viacep.com.br/ws/' + cep + '/json/');
        const dados = await res.json();

        document.getElementById('post-logradouro').value = dados.logradouro;
        document.getElementById('post-bairro').value     = dados.bairro;
        document.getElementById('post-cidade').value     = dados.localidade;
        document.getElementById('post-estado').value     = dados.uf;
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
        const dados = await res.json();
        document.getElementById('resposta').textContent = JSON.stringify(dados, null, 2);
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
        document.getElementById('resposta').textContent = JSON.stringify(dados, null, 2);
    }

    async function removerCep() {
        const cep = document.getElementById('delete-cep').value;
        const res = await fetch(API + '?cep=' + cep, { method: 'DELETE' });
        const dados = await res.json();
        document.getElementById('resposta').textContent = JSON.stringify(dados, null, 2);
    }
</script>

</body>
</html>

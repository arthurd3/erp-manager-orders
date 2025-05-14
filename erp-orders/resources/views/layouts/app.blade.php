<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Título Padrão')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto px-4">
        <header class="py-4">
            <nav class="flex justify-between items-center">
                <a href="{{ route('produtos.create') }}" class="text-blue-500 hover:text-blue-700">Cadastrar Produto</a>
                <a href="{{ route('produtos.create') }}" class="text-blue-500 hover:text-blue-700">Carrinho de Produto</a>
                <a href="{{ route('produtos.index') }}" class="text-blue-500 hover:text-blue-700">Listagem de Produto</a>
            </nav>
        </header>

        <main class="my-8">
            @yield('content')  
        </main>

        
    </div>

</body>

</html>

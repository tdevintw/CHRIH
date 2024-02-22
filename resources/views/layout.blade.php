<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>BasmaSHop</title>
    <link rel="icon" type="image/x-icon" href="https://dynamic.brandcrowd.com/asset/logo/cc6e610e-67f9-4de3-95b1-d55795a240f2/logo-search-grid-2x?logoTemplateVersion=2&v=638371196642500000&text=BasmaShop">
</head>

<body>
    @include('includes.nav')
    @yield('content')
    @include('includes.footer')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
</body>

</html>

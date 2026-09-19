<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Voting OSIS')</title>

</script>
    </script>
    <script src="https://unpkg.com/lucide@0.344.0/dist/umd/lucide.min.js" crossorigin="anonymous"></script>
    <style>
        :root {
    --bg-main: #fffff7;   
    --bg-card: #fdfbfb;  
    --bg-card-alt: #dde3ec; 
    --bg-input: #ffffff;    
    --border: #c2cad6;      
    --border-hover: #94a3b8;
    --text-main: #0f172a;
    --text-muted: #475569;
    --text-light: #64748b;
    --sky-main: #4670e5;
    --sky-hover: #384eca;
    --sky-bg: #e0e7ff;
    --sky-border: #a5b4fc;
    --emerald-main: #0d9488;
    --emerald-bg: #ccfbf1;
    --emerald-border: #5eead4;
    --amber-main: #d97706;
    --amber-bg: #fef3c7;
    --amber-border: #fde68a;
    --rose-main: #e11d48;
    --rose-bg: #ffe4e6;
    --rose-border: #fecdd3;
    --shadow-sm: 0 2px 4px rgba(15, 23, 42, 0.06);
    --shadow-lg: 0 10px 20px -3px rgba(15, 23, 42, 0.15);
    }
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    }
    .school-highlight {
    color: var(--text-main);
    font-weight: 600;
    }
    body { background-color: var(--bg-main); color: var(--text-main); min-height: 100vh; display: flex; flex-direction: column; }
    </style>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
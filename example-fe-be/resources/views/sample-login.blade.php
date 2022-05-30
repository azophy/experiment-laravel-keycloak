<html>
<head>
    <script src="http://localhost:8080/js/keycloak.js"></script>
    <script>
        function initKeycloak() {
            const keycloak = new Keycloak({
            url: 'http://localhost:8080/',
                realm: 'test_realm',
                clientId: 'test_client'
            });
            keycloak.init().then(function(authenticated) {
                alert(authenticated ? 'authenticated' : 'not authenticated');
            }).catch(function() {
                alert('failed to initialize');
            });
        }
    </script>
</head>
<body onload="initKeycloak()">
    <h1>Example Keycloak-Laravel Integration with separate BE-FE Approach</h1>
</body>
</html>



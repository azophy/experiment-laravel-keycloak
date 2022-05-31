@php
$KEYCLOAK_BASE_URL = 'http://localhost:8080';
$KEYCLOAK_REALM = 'test_realm';
$KEYCLOAK_CLIENT_ID = 'test_client';
                //url: 'https://keycloak.digitalservice.id',
                //realm: 'operations-jabardigitalservice',
                //clientId: 'k8s-digitalservice'
@endphp
<html>
<head>
    <script src="{{$KEYCLOAK_BASE_URL}}/js/keycloak.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Example keycloak integration</title>

</head>
<body>
    <h1>Example Keycloak-Laravel Integration with separate BE-FE Approach</h1>

<div x-data="{
    auth_status: 'unauthenticated',
    keycloak: null,

    initKeycloak() {
        this.keycloak = new Keycloak({
            url: '{{ $KEYCLOAK_BASE_URL }}',
            realm: '{{ $KEYCLOAK_REALM }}',
            clientId: '{{ $KEYCLOAK_CLIENT_ID }}'
        });
        this.keycloak.init({
            // dibutuhkan, kalau gak akan error inisialisasi. ref: https://stackoverflow.com/a/72069273
            checkLoginIframe: false,

            // if unauthenticated: automatically redirect
            //onLoad: 'login-required',
        }).then((authenticated) => {
            this.auth_status = authenticated ? 'authenticated' : 'un-authenticated'
        }).catch((e) => {
            this.auth_status = 'Error: Initialization failed'
            console.log(e)
        });
    },

    loadProtectedRoute() {
        const url = './api/protected';

        fetch(url,{
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + this.keycloak.token,
            }
        })
        .then(res => res.text())
        .then(res => alert(res))
        ;
    },

    loadKeycloakUserProfile() {
        this.keycloak.loadUserProfile()
        .then((profile) => {
            alert(JSON.stringify(profile));
        }).catch(function() {
            alert('Failed to load user profile');
        });
    },

    init() {
        this.auth_status = 'Initializing....'
        this.initKeycloak()
        window.coba = this
    }
}">
    <p>
        auth_status: <span x-text="auth_status"></span>
    </p>

    <button x-show="auth_status != 'authenticated'" @click="keycloak.login()">
        Log In
    </button>
    <button x-show="auth_status == 'authenticated'" @click="loadKeycloakUserProfile()">
        load keycloak user profile
    </button>
    <button x-show="auth_status == 'authenticated'" @click="loadProtectedRoute()">
        load protected path
    </button>
    <button x-show="auth_status == 'authenticated'" @click="keycloak.logout()">
        Log Out
    </button>
</div>
</body>
</html>



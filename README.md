<ol>
  <li>set oauth/token in cros.php in config folder in ServerSide then change supports_credentials to true</li><br>
  <li>edit axios file in boot folder 
      <ul>
          <br><li>change baseURL to http://localhost:8000</li>
      </ul>
  </li><br>
  <li>create new store auth-store 
      <ul>
          <br><li>Write state for User Login</li>
          <br><li>Write isAuthorized for User Login</li>
          <br><li>Write Actions(authenticate, logout, import, export) for User Login</li>
      </ul>
  </li><br>
  <li>create models folder
      <ul>
          <br><li>create user model</li>
      </ul>
  </li><br>
  <li>edit login page
      <ul>
          <br><li>set click event on login button</li>
          <br><li>Write login function in script</li>
      </ul>
  </li><br>
  <li>create new boot auth
      <ul>
          <br><li>add auth in boot in quasar.config.js  file</li>
      </ul>
  </li><br>
  <li>set condition for route and redirect it
      <ul>
          <br><li>when the user is logged in, the user is redirected to the dashboard and can't go back to the login page and contrariwise</li>
      </ul>
  </li><br>
  <li>edit dashboard layout
      <ul>
          <br><li>create and set click event on logout button</li>
          <br><li>Write logout function in script</li>
      </ul>
  </li><br>
</ol>

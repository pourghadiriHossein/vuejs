<template>
  <q-page class="window-height window-width row justify-center items-center">
    <div class="column">
      <div class="row">
        <h5 class="text-h5 text-white q-my-md">Welcome To Open World</h5>
      </div>
      <div class="row">
        <q-card square bordered class="q-pa-lg">
          <q-card-section>
            <q-form class="q-gutter-md">
              <q-list class="bg-red q-pa-sm text-white" :hidden="hidden">
                <q-item>
                  <q-btn size="sm" color="trasparent" dense icon="close" @click="closeErrorPart()"></q-btn>
                </q-item>
                <q-separator inset dark />

                <q-item>
                  <q-item-section>
                    {{errorMessage.message }}
                  </q-item-section>
                </q-item>
              </q-list>
              <q-input square filled clearable v-model:model-value="guestUser.username" type="email" label="Email" />
              <q-input square filled clearable v-model:model-value="guestUser.password" type="password" label="Password" />
            </q-form>
          </q-card-section>
          <q-card-actions class="q-px-md">
            <q-btn @click="login" unelevated color="light-blue-8" size="lg" class="full-width" label="login"/>
            <q-btn @click="register" unelevated color="red" size="lg" class="full-width q-ma-sm" label="Register"/>
          </q-card-actions>
          <q-card-section class="text-center q-pa-none">
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { ref } from 'vue';
import { useAuthStore } from 'src/stores/auth-store'
import { useRouter } from 'vue-router';

export default {
    data () {
      const authStore = useAuthStore();
      const router = useRouter();
      const guestUser = ref({
        username: '',
        password: '',
      });
      const hidden = ref(true);
      const errorMessage = ref({
        message:  '',
      });
      return {
        hidden,
        errorMessage,
        guestUser,
        closeErrorPart() {
          hidden.value = true;
        },
        login () {
          authStore
          .authenticate(guestUser.value.username, guestUser.value.password)
          .then(() => {
            router.replace({name: 'dashboard'})
          },
          (error) => {
            console.log(`No Internet, Connection Lost because server not serve!!!\n${error}`);
            if(error.response.status != 200){
                if(error.response.data.message) {
                  errorMessage.value.message = error.response.data.message
                  hidden.value = false;
                }
              }
          })
        },
        register() {
          router.replace({name: 'register'})
        },
      }
    }
}
</script>

<style>
.q-page {
  background-image: url(../../image/loginWallpaper.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
.q-card {
  width: 400px;
}
</style>

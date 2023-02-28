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

                <q-item v-for="item in errorMessage.error" :key="item">
                  <q-item-section>
                    {{item[0] }}
                  </q-item-section>
                </q-item>
              </q-list>
              <q-input square filled clearable v-model:model-value="newUser.name" type="text" label="First Name & Last Name" />
              <q-input square filled clearable v-model:model-value="newUser.email" type="email" label="Email" />
              <q-input square filled clearable v-model:model-value="newUser.password" type="password" label="Password" />
              <q-file filled bottom-slots v-model:model-value="newUser.avatar" label="Avatar" counter>
                <template v-slot:prepend>
                  <q-icon name="cloud_upload" @click.stop.prevent />
                </template>
                <template v-slot:append>
                  <q-icon name="close" @click.stop.prevent="newUser.avatar = null" class="cursor-pointer" />
                </template>

                <template v-slot:hint>
                  File Size
                </template>
              </q-file>
            </q-form>
          </q-card-section>
          <q-card-actions class="q-px-md">
            <q-btn @click="register" unelevated color="light-blue-8" size="lg" class="full-width" label="Register"/>
            <q-btn @click="login" unelevated color="red" size="lg" class="full-width q-ma-sm" label="Login"/>
          </q-card-actions>
          <q-card-section class="text-center q-pa-none">
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { User } from 'src/models/user';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    data () {
      const hidden = ref(true);
      const errorMessage = ref({
        error:  []
      })
      const newUser = ref({
        name:  '',
        email: '',
        password: '',
        avatar: []
      });
      const router = useRouter();
      return {
        hidden,
        errorMessage,
        newUser,
        closeErrorPart() {
          hidden.value = true;
        },
        register () {
          User.register(
            newUser.value.name,
            newUser.value.email,
            newUser.value.password,
            newUser.value.avatar
            )
          .then(
            () => { router.replace({name: 'login'}) },
            (error) => {
              if(error.response.status != 200){
                if(error.response.data.errors) {
                  errorMessage.value.error = error.response.data.errors
                  hidden.value = false;
                }
              }
            }
          )
        },
        login() {
          router.replace({name: 'login'})
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

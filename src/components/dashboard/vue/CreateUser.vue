<script setup lang="ts">
  import { defineProps, defineEmits, ref } from 'vue';

  const model = ref(null);

  const props = defineProps({
    modelValue: {
      default: false,
    },
    id: {
      default: 0
    },
    username: {
      default: ''
    },
    email: {
      default: ''
    }
  });

  const emit = defineEmits(['update:model-value', 'accepted']);

  const close = () => {
    emit.call(this, 'update:model-value', false);
  };
  const accepted = () => {
    emit.call(this, 'accepted');
  };
</script>

<template>

  <q-dialog :model-value="modelValue" persistent>
    <q-card style="min-width: 350px">
      <q-card-section>
        <div class="text-h6">Create New User</div>
      </q-card-section>
      <q-card-section class="q-pt-none">
        <q-input dense @keyup.enter="modelValue" :model-value="username" label="Enter Your User Name"/>
      </q-card-section>
      <q-card-section class="q-pt-none">
        <q-input dense @keyup.enter="modelValue" :model-value="email" label="Enter Your E-Mail"/>
      </q-card-section>
      <q-card-section class="q-pt-none">
        <q-input type="password" dense @keyup.enter="modelValue" model-value="" label="Enter Your Password"/>
      </q-card-section>
      <q-card-section class="q-pt-none">
        <q-file filled bottom-slots v-model="model" label="Avatar" counter>
          <template v-slot:prepend>
            <q-icon name="cloud_upload" @click.stop.prevent />
          </template>
          <template v-slot:append>
            <q-icon name="close" @click.stop.prevent="model = null" class="cursor-pointer" />
          </template>
          <template v-slot:hint>
            File Size
          </template>
        </q-file>
      </q-card-section>
      <q-card-actions align="right" class="text-primary">
        <q-btn color="red" icon-right="close" label="Cancel" @click="close"/>
        <q-btn color="light-blue-8" icon-right="create" label="Creata" @click="accepted"/>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<style>
.confirm-dialog {
  width: 95%;
  max-width: 400px;
}
</style>

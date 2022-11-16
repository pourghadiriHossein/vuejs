<script setup lang="ts">
  import { defineProps, defineEmits, ref } from 'vue';

  const props = defineProps({
    modelValue: {
      default: false,
    },
    id: {
      default: 0
    },
    img: {
      default: 'No Image'
    },
    title: {
      default: 'Title'
    },
    username: {
      default: 'name'
    },
    description: {
      default: 'No Description'
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
    <q-card class="my-card" style="min-width: 350px;">
      <q-img :src="img" />
      <q-card-section>
        <q-btn
          fab
          color="primary"
          icon="place"
          class="absolute"
          style="top: 0; right: 12px; transform: translateY(-50%);"
        />
        <div class="row no-wrap items-center">
          <div class="col text-h6 ellipsis">
            {{ title }}
          </div>
        </div>
      </q-card-section>
      <q-card-section class="q-pt-none">
        <div class="text-subtitle1">
          {{ username }}
        </div>
        <div class="text-caption text-grey">
          {{ description }}
        </div>
      </q-card-section>
      <q-separator />
      <q-card-actions align="right">
        <q-btn color="light-blue-8" icon-right="close" label="Cancel" @click="close"/>
        <q-btn color="red" icon-right="delete" label="Remove" @click="accepted"/>
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

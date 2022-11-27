<template>
  <div class="q-pa-md">
    <q-table
      :grid="$q.screen.xs"
      title="My Posts"
      :rows="rows"
      :columns="columns"
      row-key="name"
      :filter="filter"
    >
      <template v-slot:top-right>
        <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>
      <template v-slot:header="props">
          <q-tr :props="props">
            <q-th
              v-for="col in props.cols"
              :key="col.name"
              :props="props"
              >
              {{ col.label }}
            </q-th>
            <q-th auto-width>
              Tools
            </q-th>
          </q-tr>
        </template>
        <template v-slot:body="props">
          <q-tr :props="props">
            <q-td
              v-for="col in props.cols"
              :key="col.name"
              :props="props"
            >
              {{ col.value }}
            </q-td>
            <q-td auto-width>
              <q-btn class="q-ma-sm" size="md" color="warning" dense icon="update" @click="openConfirmUpdatePostDialog(props.row)"/>
              <q-btn class="q-ma-sm" size="md" color="red" dense icon="delete" @click="openConfirmDeletePostDialog(props.row)"/>
            </q-td>
          </q-tr>
        </template>
    </q-table>
  </div>
  <update-post
  v-model:model-value="confirmOpenUpdatePost"
  :id="updatePostParameter.id"
  :title="updatePostParameter.title"
  :description="updatePostParameter.description"
  :latitude="updatePostParameter.latitude"
  :longitude="updatePostParameter.longitude"
  ></update-post>
  <delete-post
  v-model:model-value="confirmOpenDeletePost"
  :id="deletePostParameter.id"
  :img="deletePostParameter.img"
  :title="deletePostParameter.title"
  :username="deletePostParameter.username"
  :description="deletePostParameter.description"
  :latitude="deletePostParameter.latitude"
  :longitude="deletePostParameter.longitude"
  ></delete-post>
</template>

<script lang="ts" setup>
  import { ref } from 'vue'
  import {columns, rows} from 'src/components/dashboard/ts/allPostComponent';
  import UpdatePost from 'src/components/dashboard/vue/UpdatePost.vue';
  import DeletePost from 'src/components/dashboard/vue/DeletePost.vue';

  const filter = ref('');
  const updatePostParameter = ref({
    id: <number>0,
    title: <string> '',
    description: <string> '',
    latitude: <number> 0,
    longitude: <number> 0,
  });
  const deletePostParameter = ref({
    id: <number>0,
    img: <string> '',
    title: <string> '',
    username: <string> '',
    description: <string> '',
    latitude: <number> 0,
    longitude: <number> 0,
  });
  const confirmOpenUpdatePost = ref(false);
  const openConfirmUpdatePostDialog = (row: any) => {
    updatePostParameter.value.id = row.id;
    updatePostParameter.value.title = row.title;
    updatePostParameter.value.description = row.description;
    updatePostParameter.value.latitude = row.latitude;
    updatePostParameter.value.longitude = row.longitude;
    confirmOpenUpdatePost.value = true;
  };
  const confirmOpenDeletePost = ref(false);
  const openConfirmDeletePostDialog = (row: any) => {
    deletePostParameter.value.id = row.id;
    deletePostParameter.value.img = row.image;
    deletePostParameter.value.title = row.title;
    deletePostParameter.value.username = row.name;
    deletePostParameter.value.description = row.description;
    deletePostParameter.value.latitude = row.latitude;
    deletePostParameter.value.longitude = row.longitude;
    confirmOpenDeletePost.value = true;
  };
</script>

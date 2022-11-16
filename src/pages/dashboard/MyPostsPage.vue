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
        <q-btn label="Create New Post" color="light-blue-8" class="q-ml-md" @click="createPost = true"/>
        <q-dialog v-model="createPost" persistent>
          <q-card style="min-width: 350px">
            <q-card-section>
              <div class="text-h6">Create Post</div>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-input dense @keyup.enter="createPost = false" model-value="" label="Enter Your Title"/>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <q-input type="textarea" dense @keyup.enter="createPost = false" model-value="" label="Enter Your Description"/>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-file filled bottom-slots v-model="model" label="Post Image" counter>
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
              <q-btn color="red" icon-right="close" label="Cancel" @click="createPost = false"/>
              <q-btn color="light-blue-8" icon-right="create" label="Create" />
            </q-card-actions>
          </q-card>
        </q-dialog>
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
  ></update-post>
  <delete-post
  v-model:model-value="confirmOpenDeletePost"
  :id="deletePostParameter.id"
  :img="deletePostParameter.img"
  :title="deletePostParameter.title"
  :username="deletePostParameter.username"
  :description="deletePostParameter.description"
  ></delete-post>
</template>

<script lang="ts" setup>
  import { ref } from 'vue'
  import {columns, rows} from 'src/components/dashboard/ts/myPostComponent';
  import UpdatePost from 'src/components/dashboard/vue/UpdatePost.vue';
  import DeletePost from 'src/components/dashboard/vue/DeletePost.vue';
  import {profile} from 'src/components/dashboard/ts/profileComponent';

  const createPost = ref(false);
  const model = ref(null);
  const filter = ref('');
  const updatePostParameter = ref({
    id: <number>0,
    title: <string> '',
    description: <string> ''
  });
  const deletePostParameter = ref({
    id: <number>0,
    img: <string> '',
    title: <string> '',
    username: <string> '',
    description: <string> ''
  });
  const confirmOpenUpdatePost = ref(false);
  const openConfirmUpdatePostDialog = (row: any) => {
    updatePostParameter.value.id = row.id;
    updatePostParameter.value.title = row.title;
    updatePostParameter.value.description = row.description;
    confirmOpenUpdatePost.value = true;
  };
  const confirmOpenDeletePost = ref(false);
  const openConfirmDeletePostDialog = (row: any) => {
    deletePostParameter.value.id = row.id;
    deletePostParameter.value.img = row.image;
    deletePostParameter.value.title = row.title;
    deletePostParameter.value.username = profile.username;
    deletePostParameter.value.description = row.description;
    confirmOpenDeletePost.value = true;
  };
</script>

<template>
  <div class="q-pa-md">
    <q-table
      :grid="$q.screen.xs"
      title="My Users"
      :rows="rows"
      :columns="columns"
      row-key="name"
      :filter="filter"
      :rows-per-page-options="[0]"
      v-model:pagination="pagination"
      @request="onRequest"
    >
      <template v-slot:top-right>
        <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-btn label="Create New User" color="light-blue-8" class="q-ml-md" @click="openConfirmCreateUserDialog()"/>
        <create-user
        v-model:model-value="confirmOpenCreateUser"
        :id="createUserDialogBox.id"
        :username="createUserDialogBox.username"
        :email="createUserDialogBox.email"
        :refresh="onRequest"
        ></create-user>
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
              {{ "Tools" }}
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
              <q-btn class="q-ma-sm" size="md" color="warning" dense icon="update" @click="openConfirmUpdateUserDialog(props.row)"/>
              <q-btn class="q-ma-sm" size="md" color="red" dense icon="delete" @click="openConfirmDeleteUserDialog(props.row)"/>
            </q-td>
          </q-tr>
        </template>
      </q-table>
    </div>
    <update-user
    v-model:model-value="confirmOpenUpdateUser"
    :id="updateUserDialogBox.id"
    :username="updateUserDialogBox.username"
    :email="updateUserDialogBox.email"
    :role="updateUserDialogBox.role"
    :refresh="onRequest"
    ></update-user>
    <delete-user
    v-model:model-value="confirmOpenDeleteUser"
    :id="deleteUserDialogBox.id"
    :username="deleteUserDialogBox.username"
    :email="deleteUserDialogBox.email"
    :refresh="onRequest"
    ></delete-user>
  </template>

<script lang="ts" setup>
  import { ref } from 'vue'
  import {columns, rows, pagination, onRequest} from 'src/components/dashboard/ts/allUserComponent';
  import CreateUser from 'src/components/dashboard/vue/CreateUser.vue'
  import UpdateUser from 'src/components/dashboard/vue/UpdateUser.vue'
  import DeleteUser from 'src/components/dashboard/vue/DeleteUser.vue'

  const filter = ref('');
  const createUserDialogBox = ref({
    id: <number> 0,
    username: <string> '',
    email: <string> '',
  });
  const updateUserDialogBox = ref({
    id: <number> 0,
    username: <string> '',
    email: <string> '',
    role: <string> '',
  });
  const deleteUserDialogBox = ref({
    id: <number> 0,
    username: <string> '',
    email: <string> '',
  });
  const confirmOpenCreateUser = ref(false);
  const openConfirmCreateUserDialog = () => {
    createUserDialogBox.value.id = 0;
    createUserDialogBox.value.username = '';
    createUserDialogBox.value.email = '';
    confirmOpenCreateUser.value = true;
  };
  const confirmOpenUpdateUser = ref(false);
  const openConfirmUpdateUserDialog = (row: any) => {
    updateUserDialogBox.value.id = row.id;
    updateUserDialogBox.value.username = row.name;
    updateUserDialogBox.value.email = row.email;
    updateUserDialogBox.value.role = row.roles[0].name;
    confirmOpenUpdateUser.value = true;
  };
  const confirmOpenDeleteUser = ref(false);
  const openConfirmDeleteUserDialog = (row: any) => {
    deleteUserDialogBox.value.id = row.id;
    deleteUserDialogBox.value.username = row.name;
    deleteUserDialogBox.value.email = row.email;
    confirmOpenDeleteUser.value = true;
  };
</script>

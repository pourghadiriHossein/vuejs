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
        <q-btn label="Create New User" color="light-blue-8" class="q-ml-md" @click="createUser = true"/>
        <q-dialog v-model="createUser" persistent>
          <q-card style="min-width: 350px">
            <q-card-section>
              <div class="text-h6">Create User</div>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-input dense @keyup.enter="createUser = false" label="Enter Your User Name"/>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-input dense @keyup.enter="createUser = false" label="Enter Your E-Mail"/>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-input type="password" dense @keyup.enter="createUser = false" label="Enter Your Password"/>
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
              <q-btn color="red" icon-right="close" label="Cancel" @click="createUser = false"/>
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
              {{ label = "Tools" }}
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
              <q-btn class="q-ma-sm" size="md" color="warning" dense icon="update" @click="updateUser = true"/>
              <q-btn class="q-ma-sm" size="md" color="red" dense icon="delete" @click="deleteUser = true"/>
              <q-dialog v-model="updateUser" persistent>
                <q-card style="min-width: 350px">
                  <q-card-section>
                    <div class="text-h6">Update User</div>
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                    <q-input dense @keyup.enter="updateUser = false" label="Enter Your User Name"/>
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                    <q-input dense @keyup.enter="updateUser = false" label="Enter Your E-Mail"/>
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                    <q-input type="password" dense @keyup.enter="updateUser = false" label="Enter Your Password"/>
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
                    <q-btn color="red" icon-right="close" label="Cancel" @click="updateUser = false"/>
                    <q-btn color="light-blue-8" icon-right="create" label="Update" />
                  </q-card-actions>
                </q-card>
              </q-dialog>
              <q-dialog v-model="deleteUser">
                <q-card>
                  <q-card-section class="row items-center">
                    <q-avatar icon="person" color="primary" text-color="white" />
                    <span class="q-ml-sm">Are You Sure, Want You To Delete This User?</span>
                  </q-card-section>

                  <q-card-actions align="right">
                    <q-btn color="light-blue-8" icon-right="close" label="Cancel" @click="deleteUser = false"/>
                    <q-btn color="red" icon-right="delete" label="Delete" />
                  </q-card-actions>
                </q-card>
              </q-dialog>
            </q-td>
          </q-tr>
        </template>
    </q-table>
  </div>
</template>

<script>
import { ref } from 'vue'
import {columns, rows} from 'src/components/dashboard/allUserComponent';
export default {
  setup () {
    return {
      createUser: ref(false),
      updateUser: ref(false),
      deleteUser: ref(false),
      model: ref(null),
      filter: ref(''),
      columns,
      rows
    }
  }
}

</script>

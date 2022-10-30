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
              <q-input dense @keyup.enter="createPost = false" label="Enter Your Title"/>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <q-input type="textarea" dense @keyup.enter="createPost = false" label="Enter Your Description"/>
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
              <q-btn class="q-ma-sm" size="md" color="warning" dense icon="update" @click="updatePost = true"/>
              <q-btn class="q-ma-sm" size="md" color="red" dense icon="delete" @click="deletePost = true"/>
              <q-dialog v-model="updatePost" persistent>
                <q-card style="min-width: 350px">
                  <q-card-section>
                    <div class="text-h6">Update Post</div>
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                    <q-input dense @keyup.enter="updatePost = false" label="Enter Your Title"/>
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                      <q-input type="textarea" dense @keyup.enter="updatePost = false" label="Enter Your Description"/>
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
                    <q-btn color="red" icon-right="close" label="Cancel" @click="updatePost = false"/>
                    <q-btn color="light-blue-8" icon-right="update" label="Update" />
                  </q-card-actions>
                </q-card>
              </q-dialog>
              <q-dialog v-model="deletePost">
                <q-card class="my-card" style="min-width: 350px;">
                  <q-img src="src/image/mountains.jpg" />
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
                        Masal
                      </div>
                    </div>
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                    <div class="text-subtitle1">
                      Hossein Pourghadiri
                    </div>
                    <div class="text-caption text-grey">
                      Best Mountains and View In World
                    </div>
                  </q-card-section>
                  <q-separator />
                  <q-card-actions align="right">
                    <q-btn color="light-blue-8" icon-right="close" label="Cancel" @click="deletePost = false"/>
                    <q-btn color="red" icon-right="delete" label="Remove" />
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
import {columns, rows} from 'src/components/dashboard/myPostComponent';
export default {
  setup () {
    return {
      createPost: ref(false),
      updatePost: ref(false),
      deletePost: ref(false),
      model: ref(null),
      filter: ref(''),
      columns,
      rows
    }
  }
}

</script>

<template>
  <v-card
    class="mb-5 elevation-0"
    color="grey lighten-4"
    flat
    tile
  >
    <v-toolbar app>
      <v-app-bar-nav-icon @click="$emit('toggleDrawer')"></v-app-bar-nav-icon>

      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-menu
            transition="slide-y-transition"
            bottom
            left
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                dark
                icon
                v-bind="attrs"
                v-on="on"
              >
                <v-icon color="black">mdi-dots-vertical</v-icon>
              </v-btn>
            </template>

            <v-list>
              <v-list-item
                v-for="(item, i) in items"
                :key="i"
              >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
                <v-divider></v-divider>
              </v-list-item>
            </v-list>
          </v-menu>
    </v-toolbar>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      items: [
        { title: 'My profile' },
        { title: 'Log out' }
      ],
    }),
  }
</script>
<template>
  <q-page class="flex flex-center">
    <q-card class="my-card">
      <q-card-section>
        <q-form
          @submit="onSubmit"
          @reset="onReset"
          class="q-gutter-md"
          ref="loginForm"
        >
          <q-input
            filled
            clearable
            clear-icon="close"
            v-model="form.email"
            label="Email *"
            hint="Informe o email"
            lazy-rules
            :rules="[
              (val) => (val && val.length > 3) || 'Informe um email valido',
            ]"
            class="col-md-12 col-sm-12 col-xs-12"
          />
          <q-input
            filled
            type="password"
            clearable
            clear-icon="close"
            v-model="form.password"
            label="Senha *"
            hint="Digite a senha"
            lazy-rules
            :rules="[(val) => val && val.length > 0 || 'Informe a senha']"
            class="col-md-12 col-sm-12 col-xs-12"
          />
          <div>
            <q-btn label="Entrar" type="submit" color="green" />
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "PageLogin",
  data() {
    return {
      
      form: {
        email: "",
        password: "",
      },
    };
  },

  methods: {
    onSubmit() {

      this.$q.notify({
        message: 'Cadastro realizado com sucesso',
         progress: true,
        type: 'positive',
        
        
      })
      this.onReset();
    },
    onReset() {
      this.form = {
        password: "",
        email: "",
      };
      this.$refs.loginForm.resetValidation();
    },
  },
});
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 500px
</style>

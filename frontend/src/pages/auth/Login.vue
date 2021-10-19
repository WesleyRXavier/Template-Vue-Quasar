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
            :rules="[(val) => (val && val.length > 0) || 'Informe a senha']"
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
import { useQuasar } from "quasar";

export default defineComponent({
  name: "PageLogin",

  data() {
    return {
      error: false,
      form: {
        email: "lkessler@example.net",
        password: "passwordq",
      },
    };
  },

  methods: {
    onSubmit() {
      this.$api
        .post("/login", this.form)
        .then(
          (res) => {
            window.localStorage.setItem("USER_TOKEN", res.data.token);
            this.onReset();
          },
          (error) => {
            this.error = true;
            window.localStorage.removeItem("USER_TOKEN");
            return Promise.reject(error);
          }
        )
        .catch((error) => {
          if (error.response) {
            console.error(error.message);
            this.msgError(error.response.data.message);
          } else if (error.request) {
            console.error(error.message);
            this.msgError(
              `Erro ao tentar comunicar com servidor: ${error.message}`
            );
          } else {
            console.error(error.request);
            console.error(error.message);
            this.msgError(
              `Erro ao fazer requisição ao servidor: ${error.message}`
            );
          }
        });
    },
    msgError(message) {
      this.$q.notify({
        color: "negative",
        position: "top",
        message: message,
        icon: "report_problem",
        progress: true,
      });
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

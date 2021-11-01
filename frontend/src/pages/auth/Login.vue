<template>
  <q-page class="flex flex-center">
    <q-card class="my-card">
      <q-card-section>
        <q-form
          @submit="onSubmit"
          @reset="onReset"
          class="q-gutter-md"
          ref="loginForm"
          >{{ error }}
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
            :error="error"
            @change="clearError"
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
            :error="error"
            @change="clearError"
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
import { mapActions } from "vuex";
export default defineComponent({
  name: "PageLogin",

  data() {
    return {
      error: false,
      form: {
        email: "lkessler@example.net",
        password: "password",
      },
    };
  },

  methods: {
    ...mapActions("app", ["LOGIN"]),
    async onSubmit() {
      try {
        await this.LOGIN(this.form);
        this.$router.push({ name: "home" });
        this.onReset();
  

      } catch (err) {
        this.error = true;
        
      }
    },
    onReset() {
      this.form = {
        password: "",
        email: "",
      };
      this.$refs.loginForm.resetValidation();
    },
    clearError() {
      this.error = false;
    },
  },
});
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 500px
</style>

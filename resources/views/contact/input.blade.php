<html>
<head>
  <link href="//cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css" rel="stylesheet" id="bootstrap-css">
  <style>

    .error_txt {
      margin-bottom: 10px;
      display: block;
      color: #f00;
      font-size: 13px;
    }

    .foundation-example__ex-wrapper {
      background-color: lightblue;
    }

    .foundation-example__in-wrapper {
      margin: auto;
      max-width: 960px;
      background: white;
      padding: 30px;
    }

    .foundation-example__title {
      font-size: 40px;
      margin-bottom: 25px;
    }

  </style>
</head>
<body>
<section id="app">
  <div style="height: 50px;background: lightblue;"></div>
  <div class="foundation-example__ex-wrapper">
    <div class="foundation-example__in-wrapper">
      <div class="foundation-example__title">お問い合わせ</div>
      <form v-if="!emailSent">
        <div class="row">
          <div class="large-6 columns">
            <label>名
              <input type="text" v-model="firstName">
              <div class="error_txt" v-html="errors.firstName"></div>
            </label>
            <label>メールアドレス
              <input type="text" v-model="email">
              <div class="error_txt" v-html="errors.email"></div>
            </label>
          </div>
          <div class="large-6 columns">
            <label>姓
              <input type="text" v-model="lastName">
              <div class="error_txt" v-html="errors.lastName"></div>
            </label>
            <label>ご用件
              <select v-model="subjectId">
                <option value="">洗濯してください</option>
                <option v-for="(subject, id) in subjects" :value="id" v-text="subject"></option>
              </select>
              <div class="error_txt" v-html="errors.subjectId"></div>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="large-12 columns">
            <label>お問い合わせ内容
              <textarea rows="10" placeholder="お問い合わせの内容をご入力ください。" v-model="body"></textarea>
              <div class="error_txt" v-html="errors.body"></div>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="large-12 columns text-center">
            <button class="button expanded" type="button" @click="onSubmit()">送信する</button>
          </div>
        </div>
      </form>
      <div v-if="emailSent">メッセージが送信されました。ありがとうございました。</div>
    </div>
  </div>
  <div style="height: 50px;background: lightblue;"></div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script>

  new Vue({
    el: '#app',
    data: {
      errors: {},
      emailSent: false,
      firstName: '',
      lastName: '',
      email: '',
      subjectId: '',
      body: '',
      subjects: {
        100: '商品に関する質問',
        200: 'お支払に関する質問',
        300: 'ショッピングに関する質問',
        400: 'ポイントに関する質問',
        500: 'ご質問・その他'
      }
    },
    methods: {
      onSubmit: function () {
        if (!confirm('送信しますか？')) {
          return;
        }

        let params = {
          firstName: this.firstName,
          lastName: this.lastName,
          email: this.email,
          subjectId: this.subjectId,
          body: this.body
        };

        let self = this;

        axios.post('/contact', params).then(function (response) {
          self.emailSent = true;
        }).catch(function (error) {
          let errors = {};

          for (let key in error.response.data.errors) {
            errors[key] = error.response.data.errors[key].join('<br>');
          }

          self.errors = errors;
        });
      }
    }
  });

</script>
</body>
</html>

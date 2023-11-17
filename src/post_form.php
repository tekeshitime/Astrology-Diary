<?php include './layout/header.php'; ?>

<form class="max-w-screen-md mx-auto p-4 md:p-8">
  <p class="text-4xl font-bold text-gray-400">2023/11/17</p>

  <div class="flex h-40 items-center">
    <div>感情</div>
    <div class="flex items-center">
      <input id="mood-radio-1" type="radio" value="" name="mood-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-radio-1" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😱</label>
    </div>
    <div class="flex items-center">
      <input checked id="mood-radio-2" type="radio" value="" name="mood-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-radio-2" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😥</label>
    </div>
    <div class="flex items-center">
      <input checked id="mood-radio-3" type="radio" value="" name="mood-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-radio-3" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😀</label>
    </div>
    <div class="flex items-center">
      <input checked id="mood-radio-4" type="radio" value="" name="mood-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-radio-4" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😋</label>
    </div>
    <div class="flex items-center">
      <input checked id="mood-radio-5" type="radio" value="" name="mood-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-radio-5" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">🥰</label>
    </div>
  </div>


  <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">今日はどんな一日だった？</label>
  <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="今日は新しいプロジェクトの計画を立てる日だった。目標はクリアになりつつあるが、まだ課題も多い。明日は早起きして集中して取り組もう。自分に厳しく、でも無理せず進んでいこう。"></textarea>

  <div class="text-center mt-4">
    <button type="submit" class="text-white w-96 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">日記を投稿する</button>
  </div>

</form>

<?php include './layout/footer.php'; ?>

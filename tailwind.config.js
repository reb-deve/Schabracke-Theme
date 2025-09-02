module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./assets/js/**/*.js"
  ],
  theme: { extend: {} },
  plugins: [],
  safelist: [
  'grid','grid-cols-7','rounded-lg','shadow-sm','space-y-4','space-y-6',
  'px-3','px-4','px-6','py-1','py-2','py-6','text-sm','text-lg','text-xl','text-3xl',
  'bg-white','bg-gray-50','border','border-blue-500','text-blue-600','text-gray-600','text-gray-800'
]

};

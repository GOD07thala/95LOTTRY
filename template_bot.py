from aiogram import Bot, Dispatcher, types, executor

API_TOKEN = "CHILD_BOT_TOKEN"
bot = Bot(token=API_TOKEN)
dp = Dispatcher(bot)

@dp.message_handler(commands=['start'])
async def start(msg: types.Message):
    btn = types.ReplyKeyboardMarkup(resize_keyboard=True)
    btn.add("💰 Balance", "➕ Add Money", "📤 Withdraw")
    await msg.answer("🤖 Welcome to your UPI bot!", reply_markup=btn)

@dp.message_handler(lambda m: m.text == "💰 Balance")
async def balance(msg: types.Message):
    await msg.reply("💳 Your balance: ₹0.00")

@dp.message_handler(lambda m: m.text == "➕ Add Money")
async def add_money(msg: types.Message):
    await msg.reply("📥 Send UPI Payment to: `upi@bank`\nThen reply with UTR ID.", parse_mode="Markdown")

@dp.message_handler(lambda m: m.text == "📤 Withdraw")
async def withdraw(msg: types.Message):
    await msg.reply("💸 Enter your UPI ID to withdraw funds.")

if __name__ == '__main__':
    executor.start_polling(dp, skip_updates=True)
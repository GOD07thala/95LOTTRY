from aiogram import Bot, Dispatcher, types, executor
import json, os

API_TOKEN = 'MAIN_BOT_TOKEN'
bot = Bot(token=API_TOKEN)
dp = Dispatcher(bot)

@dp.message_handler(commands=['start'])
async def start_cmd(msg: types.Message):
    btn = types.InlineKeyboardMarkup()
    btn.add(types.InlineKeyboardButton("🛠 Create UPI Bot", callback_data="create_bot"))
    btn.add(types.InlineKeyboardButton("🤖 My Bots", callback_data="my_bots"))
    await msg.answer("👋 Welcome! Create your own UPI bot below.", reply_markup=btn)

@dp.callback_query_handler(lambda c: c.data == "create_bot")
async def ask_token(cb: types.CallbackQuery):
    await cb.message.answer("📥 Send your Bot Token (get from @BotFather):")
    await cb.answer()
    dp.register_message_handler(save_token, state=None)

async def save_token(msg: types.Message):
    token = msg.text.strip()
    user_id = msg.from_user.id

    with open("data/bots.json", "r+") as f:
        data = json.load(f)
        data[str(user_id)] = token
        f.seek(0)
        json.dump(data, f, indent=4)

    with open("template_bot.py", "r") as t, open(f"bots/bot_{user_id}.py", "w") as b:
        code = t.read().replace("CHILD_BOT_TOKEN", token)
        b.write(code)

    await msg.reply("✅ Bot created successfully!\nYou can now deploy your bot.")

@dp.callback_query_handler(lambda c: c.data == "my_bots")
async def my_bots(cb: types.CallbackQuery):
    user_id = str(cb.from_user.id)
    with open("data/bots.json", "r") as f:
        data = json.load(f)
        token = data.get(user_id, "Not created")
    await cb.message.answer(f"🤖 Your Bot Token:\n`{token}`", parse_mode="Markdown")
    await cb.answer()

if __name__ == '__main__':
    if not os.path.exists("data/bots.json"):
        with open("data/bots.json", "w") as f:
            json.dump({}, f)
    executor.start_polling(dp, skip_updates=True)
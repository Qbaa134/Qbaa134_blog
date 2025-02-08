const express = require('express');
const bodyParser = require('body-parser');
const { Configuration, OpenAIApi } = require('openai');

const app = express();
const port = 3000;

// OpenAI API setup
const configuration = new Configuration({
    apiKey: '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',
});
const openai = new OpenAIApi(configuration);

app.use(bodyParser.json());

// Endpoint do obsługi wiadomości chatbota
app.post('/chatbot-api', async (req, res) => {
    const userMessage = req.body.message;

    try {
        const completion = await openai.createChatCompletion({
            model: 'gpt-3.5-turbo', // Lub nowszy model, np. GPT-4
            messages: [{ role: 'user', content: userMessage }],
        });

        const botReply = completion.data.choices[0].message.content;
        res.json({ reply: botReply });
    } catch (error) {
        console.error('Błąd OpenAI:', error);
        res.status(500).json({ reply: 'Błąd serwera. Spróbuj ponownie później.' });
    }
});

app.listen(port, () => {
    console.log(`Serwer działa na http://localhost:${port}`);
});

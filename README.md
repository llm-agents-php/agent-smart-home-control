# Smart Home control system with LLM Agents

[![PHP](https://img.shields.io/packagist/php-v/llm-agents-php/agent-smart-home-control.svg?style=flat-square)](https://packagist.org/packages/llm-agents-php/agent-smart-home-control)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/llm-agents-php/agent-smart-home-control.svg?style=flat-square)](https://packagist.org/packages/llm-agents-php/agent-smart-home-control)
[![Total Downloads](https://img.shields.io/packagist/dt/llm-agents-php/agent-smart-home-control.svg?style=flat-square)](https://packagist.org/packages/llm-agents-php/agent-smart-home-control)

Hey there! 👋 This package gives you a cool Smart Home control system that you can use in your LLM Agents project. It's
built to work seamlessly with the LLM Agents platform, so you can easily integrate it into your project and start
controlling your smart home devices in no time.

> You can read an article about Smart Home control system with LLM Agents on [Medium](https://butschster.medium.com/a-php-devs-dream-an-ai-home-that-really-gets-you-dd97ae2ca0b0).

![image](https://github.com/user-attachments/assets/405275f8-a180-4134-806d-bc7287e779dc)

## Let's get started! 🚀

### Installation

First things first, let's get this package installed:

```bash
composer require llm-agents-php/agent-smart-home-control
```

### Setup in Spiral Framework

To get the Site Status Checker Agent up and running in your Spiral Framework project, you need to register its
bootloader.

**Here's how:**

1. Open up your `app/src/Application/Kernel.php` file.
2. Add the bootloader like this:
   ```php
   public function defineBootloaders(): array
   {
       return [
           // ... other bootloaders ...
           \LLM\Agents\Agent\SmartHomeControl\Integrations\Spiral\SmartHomeControlBootloader::class,
       ];
   }
   ```

And that's it! Your Spiral app is now ready to use the agent.

## Want to help out? 🤝

We love contributions! If you've got ideas to make this agent even cooler, here's how you can chip in:

1. Fork the repo
2. Make your changes
3. Create a new Pull Request

Just make sure your code is clean, well-commented, and follows PSR-12 coding standards.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

That's all, folks! If you've got any questions or run into any trouble, don't hesitate to open an issue.
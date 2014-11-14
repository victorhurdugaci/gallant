declare var wp: wordpress;

interface something {
    bind(callback: (value: string) => void): void;
}

interface wordpress {
    customize(option: string, callback: (name: something) => void): void;
}
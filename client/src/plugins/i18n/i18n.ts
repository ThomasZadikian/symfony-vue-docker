import { createI18n } from 'vue-i18n';
import fr from '@/plugins/i18n/locales/fr-FR.json';
import { LangEnum } from '@/core/types/enums/langEnum';

const i18n = createI18n({
  legacy: false,
  locale: LangEnum.FR,
  fallbackLocale: LangEnum.FR,
  messages: { [LangEnum.FR]: fr },
});

export default i18n;

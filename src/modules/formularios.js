// ─── Módulo de Formularios con Zod ──────────────────────────────────────────
import { z } from 'zod'

// ── Esquemas ─────────────────────────────────────────────────────────────────

export const schemaContacto = z.object({
    nombre: z.string()
        .min(2, 'El nombre debe tener al menos 2 caracteres')
        .regex(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/, 'Solo letras y espacios'),

    email: z.string()
        .email('Ingresa un correo electrónico válido'),

    telefono: z.string()
        .regex(/^\d{9}$/, 'El teléfono debe tener 9 dígitos')
        .optional().or(z.literal('')),

    mensaje: z.string()
        .min(10, 'Mínimo 10 caracteres')
        .max(1000, 'Máximo 1000 caracteres'),

    terminos: z.boolean()
        .refine(v => v === true, 'Debes aceptar los términos y condiciones'),
})

export const schemaCotizacion = z.object({
    nombre: z.string()
        .min(2, 'El nombre debe tener al menos 2 caracteres'),

    email: z.string()
        .email('Ingresa un correo electrónico válido'),

    telefono: z.string()
        .regex(/^\d{9}$/, 'El teléfono debe tener 9 dígitos')
        .optional().or(z.literal('')),

    destino: z.string()
        .min(2, 'Selecciona un destino'),

    personas: z.string()
        .regex(/^\d+$/, 'Número de personas inválido')
        .optional().or(z.literal('')),

    fecha_inicio: z.string()
        .optional().or(z.literal('')),

    mensaje: z.string()
        .min(5, 'Mínimo 5 caracteres')
        .max(1000, 'Máximo 1000 caracteres')
        .optional().or(z.literal('')),
})

// ── Función Alpine — Formulario de Contacto ───────────────────────────────────
export function initFormularios() {
    // Formulario de Contacto General
    window.formularioContacto = function () {
        return {
            nombre: '',
            email: '',
            telefono: '',
            mensaje: '',
            terminos: false,
            errores: {},
            estado: 'idle', // idle | enviando | enviado | error

            // Validar campo a campo en @blur
            validarCampo(campo) {
                const result = schemaContacto.pick({ [campo]: true })
                    .safeParse({ [campo]: this[campo] })
                if (!result.success) {
                    this.errores[campo] = result.error.flatten().fieldErrors[campo]?.[0] ?? ''
                } else {
                    delete this.errores[campo]
                }
            },

            // Validar todo en submit
            validarTodo() {
                const result = schemaContacto.safeParse({
                    nombre: this.nombre,
                    email: this.email,
                    telefono: this.telefono,
                    mensaje: this.mensaje,
                    terminos: this.terminos,
                })
                if (!result.success) {
                    const err = result.error.flatten().fieldErrors
                    this.errores = Object.fromEntries(
                        Object.entries(err).map(([k, v]) => [k, v[0] ?? ''])
                    )
                    return false
                }
                this.errores = {}
                return true
            },

            async enviar() {
                if (!this.validarTodo()) return
                this.estado = 'enviando'
                try {
                    const res = await fetch('/wp-json/intense-nerd/v1/contacto', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            nombre: this.nombre,
                            email: this.email,
                            telefono: this.telefono,
                            mensaje: this.mensaje,
                        }),
                    })
                    this.estado = res.ok ? 'enviado' : 'error'
                } catch {
                    this.estado = 'error'
                }
            },
        }
    }

    // Formulario de Cotización
    window.formularioCotizacion = function () {
        return {
            nombre: '',
            email: '',
            telefono: '',
            destino: '',
            personas: '',
            fecha_inicio: '',
            mensaje: '',
            errores: {},
            estado: 'idle',

            validarCampo(campo) {
                const result = schemaCotizacion.pick({ [campo]: true })
                    .safeParse({ [campo]: this[campo] })
                if (!result.success) {
                    this.errores[campo] = result.error.flatten().fieldErrors[campo]?.[0] ?? ''
                } else {
                    delete this.errores[campo]
                }
            },

            validarTodo() {
                const result = schemaCotizacion.safeParse({
                    nombre: this.nombre,
                    email: this.email,
                    telefono: this.telefono,
                    destino: this.destino,
                    personas: this.personas,
                    fecha_inicio: this.fecha_inicio,
                    mensaje: this.mensaje,
                })
                if (!result.success) {
                    const err = result.error.flatten().fieldErrors
                    this.errores = Object.fromEntries(
                        Object.entries(err).map(([k, v]) => [k, v[0] ?? ''])
                    )
                    return false
                }
                this.errores = {}
                return true
            },

            async enviar() {
                if (!this.validarTodo()) return
                this.estado = 'enviando'
                try {
                    const res = await fetch('/wp-json/intense-nerd/v1/cotizacion', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            nombre: this.nombre,
                            email: this.email,
                            telefono: this.telefono,
                            destino: this.destino,
                            personas: this.personas,
                            fecha_inicio: this.fecha_inicio,
                            mensaje: this.mensaje,
                        }),
                    })
                    this.estado = res.ok ? 'enviado' : 'error'
                } catch {
                    this.estado = 'error'
                }
            },
        }
    }
}
